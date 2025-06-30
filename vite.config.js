import { defineConfig } from 'vite'; // <-- ADICIONE ESTA LINHA
import laravel from 'laravel-vite-plugin';


export default defineConfig({
    plugins: [
        laravel({
            input: [
                // CSS primeiro
                'resources/assets/plugins/global/plugins.bundle.css',
                'resources/assets/css/style.bundle.css',
                
                // JS depois
                'resources/assets/plugins/global/plugins.bundle.js',
                'resources/assets/js/scripts.bundle.js',
                
                // Seus arquivos originais
                'resources/css/app.css',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
    // Adicione isso para garantir a ordem de carregamento
    build: {
        rollupOptions: {
            output: {
                manualChunks: undefined,
            }
        }
    }
});