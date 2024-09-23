import { ref, computed, getCurrentInstance } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { requestGet, requestPost, loading } from '@/utils/requests';
import { getStoredUser, loadFromLocalStorage, saveToLocalStorage } from '@/utils/localstorage';

export const user = ref(null);
export const loading;

export const authAndAutoReg = async (autoreg = false) => {
    return authLocalSaved(true);
}

export const authLocalSaved = async (autoreg = false) => {
    const userFromInertia = usePage().props.auth.user;
    debug('User from Inertia session', userFromInertia);

    if (userFromInertia) {
        return setUser(userFromInertia);
    }

    let token = loadFromLocalStorage('auth_token');
    if(token) {
        const loginUser = await autoLogin(token)
        debug('Login user:', loginUser);
        if(loginUser) {
            loginUser.token = token;
            return setUser(loginUser);
        }
    }else{
        token = createUserToken();
        saveToLocalStorage('auth_token', token);
        debug('Local token created: ', token);
    }

    if(autoreg) {
        twaUser = getTwaUser() || {};
        userId = twaUser.tgId || null;
        userName = twaUser.name || null;
        const newUser = await autoRegister(token, userId, userName) || {};
        debug('Registered user: ', newUser);

        return setUser(newUser);
    }

    return null;
}

export const logout = () => {
    logoutLocal();
    return requestPost(route('logout'));
}

const setUser = (u) => {
   user.value = u;
}

const autoLogin = async (auth_token) => {
    return await requestPost(route('login.auto'), {
        auth_token
    });
}
const autoRegister = async (auth_token, tg_id, name) => {
    const user = await requestPost(route('register.auto'), {
        auth_token,
        tg_id,
        name,
    });
    return user;
}

const logoutLocal = (removeToken = false) => {
    localStorage.removeItem('user');
    if(removeToken) {
        localStorage.removeItem('auth_token');
    }
}

const createUserToken = () => {
    const twaUser = getTwaUser();
    if (twaUser && twaUser.user.id) {
        return '' + (new Date()).getTime() + twaUser.user.id
    }
    return '' + (new Date()).getTime() + Math.random() * 1000;
}


const getTwaUser = () => {
    const TWA = getCurrentInstance().appContext.config.globalProperties.TWA;
    if (!TWA || !TWA.initDataUnsafe || !TWA.initDataUnsafe.user) return null;
    const user = TWA.initDataUnsafe.user;
    return {
        tgId: user.id || "",
        name: user.username || "",
        data: TWA.initDataUnsafe
    };
}

