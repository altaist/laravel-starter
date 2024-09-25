import { ref, computed } from 'vue';
import texts from '@/langs/texts'
import { loadFromLocalStorage, saveToLocalStorage } from './localstorage';

export const useLangs = () => {
    const l = loadFromLocalStorage('lang', 'ru-Ru');
    const currentLang = ref(l);
    const langs = [
        { id: 'ru-Ru', label: 'Русский' },
        { id: 'en', label: 'English' }
    ]

    const setCurrentLang = (lang) => {
        console.log(lang);
        currentLang.value = lang;
        saveToLocalStorage('lang', currentLang.value)
    }

    const t =(k) => (texts[k] || k)[currentLang.value] || k;

    return {
        t,
        langs,
        currentLang,
        setCurrentLang,
    }
}
