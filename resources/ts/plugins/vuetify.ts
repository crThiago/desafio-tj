import 'vuetify/styles';
import '@mdi/font/css/materialdesignicons.css';
import { createVuetify } from 'vuetify';
import { VDateInput } from 'vuetify/labs/VDateInput'

// Translations provided by Vuetify
import { en, pt } from 'vuetify/locale';

const vuetify = createVuetify({
    components: {
        VDateInput,
    },
    icons: {
        defaultSet: 'mdi',
    },
    locale: {
        locale: 'pt',
        fallback: 'en',
        messages: { pt, en },
    },
    date: {
        locale: {
            pt: 'pt-BR',
        },
    },
});

export default vuetify;
