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
    theme: {
        themes: {
            light: {
                colors: {
                    background: '#F1EFE3',
                    primary: '#E50020',
                    secondary: '#8D6E63',
                },
            },
        }
    }
});

export default vuetify;
