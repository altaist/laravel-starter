import { ref } from 'vue';
import { loadFromLocalStorage, saveToLocalStorage } from '@/utils/localstorage';


const defaultSettings = {
    user: null,
    theme: {

    }
}


export const useProject = (projectKey = 'default') => {
    const settings = ref(defaultSettings);

    const loadSettings = () => {
        settings.value = loadFromLocalStorage(projectKey);
    }

    const updateSettings = () => {
        saveToLocalStorage(projectKey, settings);
    }

    return {
        settings,
        loadSettings,
        updateSettings
    }


}


