<div class="modal fade" id="modalDeleteDefault" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="fas fa-exclamation-triangle text-danger fs-1 mb-3"></i>
                <p class="mb-0" id="modalDeleteMessage"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash-alt me-2"></i>Excluir
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteModal = new bootstrap.Modal(document.getElementById('modalDeleteDefault'));
    const deleteForm = document.getElementById('deleteForm');
    const deleteMessage = document.getElementById('modalDeleteMessage');

    // Configura o modal quando um botão de exclusão é clicado
    document.querySelectorAll('[data-bs-toggle="modal"][data-bs-target="#modalDeleteDefault"]').forEach(button => {
        button.addEventListener('click', function() {
            // Pega a URL da rota destroy e o nome do item
            const deleteUrl = this.getAttribute('data-delete-url');
            const itemName = this.getAttribute('data-item-name');
            
            console.log('URL para exclusão:', deleteUrl); // Debug
            
            // Atualiza o formulário
            deleteForm.action = deleteUrl;
            
            // Atualiza a mensagem
            deleteMessage.textContent = itemName 
                ? `Você realmente deseja excluir ${itemName}? Esta ação não pode ser desfeita.`
                : 'Você realmente deseja excluir este item? Esta ação não pode ser desfeita.';
        });
    });
});
</script>
