import { ref } from 'vue';

const locale = ref(localStorage.getItem('locale') || 'id');

export function useLanguage() {
    function setLocale(newLocale) {
        if (newLocale === 'id' || newLocale === 'en') {
            locale.value = newLocale;
            localStorage.setItem('locale', newLocale);
        }
    }

    /**
     * Translate helper.
     * If locale is 'en', returns enText if it is not empty/null.
     * Otherwise returns idText.
     */
    function t(idText, enText) {
        if (locale.value === 'en') {
            if (enText !== null && enText !== undefined && enText !== '') {
                return enText;
            }
        }
        return idText;
    }

    return {
        locale,
        setLocale,
        t
    };
}
