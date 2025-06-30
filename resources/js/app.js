import './bootstrap';

// Importar e configurar o Notyf
import { Notyf } from 'notyf';
import 'notyf/notyf.min.css'; // Não se esqueça de importar o CSS!

// Criar uma instância global para ser usada em qualquer lugar
window.notyf = new Notyf({
  duration: 4000, // Duração em milissegundos
  position: {
    x: 'right',
    y: 'top',
  },
  types: [
    {
      type: 'success',
      backgroundColor: '#3DC763',
      icon: {
        className: 'notyf__icon--success',
        tagName: 'i',
      }
    },
    {
      type: 'error',
      backgroundColor: '#ED3D3D',
      icon: {
        className: 'notyf__icon--error',
        tagName: 'i',
      }
    }
  ]
});

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
