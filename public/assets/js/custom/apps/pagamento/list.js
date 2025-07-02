"use strict";

// Mantemos o nome original do objeto do seu template para consistência
var KTUsersPermissionsList = (function () {
    // Variáveis do DataTable
    var t, e;

    return {
        init: function () {
            // Seleciona a tabela
            e = document.querySelector("#kt_permissions_table"); // Garanta que sua <table> tenha o id="kt_permissions_table"

            if (!e) {
                return;
            }

            // Inicialização do DataTable (mantida como no original)
            (t = $(e).DataTable({
                info: !1,
                order: [],
                columnDefs: [
                    { orderable: !1, targets: 1 }, // Adapte os alvos se suas colunas mudaram
                    { orderable: !1, targets: 6 }, // A coluna de ações geralmente não é ordenável
                ],
            })),
            // Lógica do campo de busca (mantida como no original)
            document.querySelector('[data-kt-permissions-table-filter="search"]').addEventListener("keyup", function (e) {
                t.search(e.target.value).draw();
            });

            // ===================================================================================
            // AQUI COMEÇA A NOSSA LÓGICA DE EXCLUSÃO ATUALIZADA
            // ===================================================================================
            e.querySelectorAll('[data-kt-permissions-table-filter="delete_row"]').forEach((e) => {
                e.addEventListener("click", function (event) {
                    event.preventDefault(); // Previne qualquer comportamento padrão do botão

                    const n = event.currentTarget.closest("tr"); // A linha <tr> a ser removida
                    const deleteUrl = event.currentTarget.dataset.urlDestroy; // Pega a URL da rota destroy
                    const pagamentoDescricao = event.currentTarget.dataset.pagamentoDescricao; // Pega a descrição para a mensagem

                    // Mensagem de confirmação com SweetAlert2
                    Swal.fire({
                        text: "Tem certeza que deseja excluir o pagamento: " + pagamentoDescricao + "?",
                        icon: "warning",
                        showCancelButton: !0,
                        buttonsStyling: !1,
                        confirmButtonText: "Sim, excluir!",
                        cancelButtonText: "Não, cancelar",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary",
                        },
                    }).then(function (result) {
                        // Se o usuário clicou em "Sim, excluir!"
                        if (result.value) {

                            // Inicia a requisição de exclusão para o servidor Laravel
                            fetch(deleteUrl, {
                                method: "DELETE",
                                headers: {
                                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                    "Content-Type": "application/json",
                                    "Accept": "application/json"
                                }
                            })
                            .then(response => {
                                // Se a resposta do servidor for OK (status 200-299)
                                if (response.ok) {
                                    return response.json();
                                }
                                // Se houver um erro, rejeita a promessa para cair no .catch()
                                return Promise.reject(response);
                            })
                            .then(data => {
                                // Mostra a mensagem de sucesso
                                Swal.fire({
                                    text: "Você excluiu '" + pagamentoDescricao + "'.",
                                    icon: "success",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    },
                                }).then(function () {
                                    // Remove a linha da tabela e redesenha o DataTable
                                    t.row($(n)).remove().draw();
                                });
                            })
                            .catch(error => {
                                // Mostra uma mensagem de erro se a exclusão falhar no servidor
                                Swal.fire({
                                    text: "Não foi possível excluir o pagamento. Tente novamente.",
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    },
                                });
                            });

                        } else if ("cancel" === result.dismiss) {
                            // Se o usuário clicou em "Não, cancelar"
                            Swal.fire({
                                text: "O pagamento '" + pagamentoDescricao + "' não foi excluído.",
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "Ok!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                },
                            });
                        }
                    });
                });
            });
        },
    };
})();

// Garante que o script rode após o carregamento do DOM
KTUtil.onDOMContentLoaded(function () {
    KTUsersPermissionsList.init();
});