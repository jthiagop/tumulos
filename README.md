<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Tumulos - Sistema de Gerenciamento de Cemitério

Este é um sistema de aplicação web robusto, desenvolvido com o framework Laravel, para o gerenciamento completo de cemitérios. O projeto visa centralizar e automatizar as operações diárias, desde o controle de túmulos e registros de falecidos até a gestão financeira dos pagamentos.

## Sobre o Projeto

O Tumulos foi criado para modernizar a administração de cemitérios, oferecendo uma plataforma intuitiva, segura e eficiente. Com um dashboard analítico, os gestores podem ter uma visão clara da ocupação, situação financeira e outros indicadores importantes em tempo real. Acreditamos que o desenvolvimento deve ser uma experiência criativa e agradável, e este projeto reflete essa filosofia ao facilitar tarefas complexas e rotineiras.

---

## ✨ Funcionalidades Principais

O sistema conta com um conjunto de funcionalidades essenciais para a gestão cemiterial:

-   **Dashboard Analítico:** Gráficos e estatísticas interativas sobre a ocupação dos túmulos, pagamentos mensais, status financeiros e mais.
-   **Gestão de Túmulos:** Cadastro, edição e visualização de túmulos, incluindo informações como código, localização detalhada e status (ocupado, livre, etc.).
-   **Registro de Falecidos:** Gerenciamento completo dos registros de pessoas falecidas, com associação aos seus respectivos túmulos.
-   **Controle Financeiro:** Módulo para registro e acompanhamento de pagamentos (taxas de manutenção, etc.), com controle de vencimentos, status (pago, pendente, vencido) e relatórios.
-   **Interface Moderna e Responsiva:** Utiliza um tema premium com componentes interativos como modais, seletores avançados (Select2) e máscaras de input para uma melhor experiência de usuário.
-   **Autenticação e Níveis de Acesso:** Sistema de login seguro para proteger os dados da aplicação (pode ser expandido com diferentes níveis de permissão).

---

## 🛠️ Tecnologias Utilizadas

Este projeto foi construído utilizando tecnologias modernas e consolidadas no mercado:

-   **Backend:** Laravel Framework, PHP
-   **Frontend:** Blade Templates, Bootstrap, JavaScript
-   **UI/UX:** Tema baseado em Metronic/Keen
-   **Bibliotecas JS:** ApexCharts.js, Select2.js, Inputmask.js, jQuery, Bootstrap JS
-   **Banco de Dados:** Compatível com MySQL, MariaDB, PostgreSQL

---

## 🚀 Como Executar o Projeto

Para instalar e executar este projeto em seu ambiente de desenvolvimento local, siga os passos abaixo.

### Pré-requisitos
- PHP (versão compatível com a do `composer.json`)
- Composer
- Node.js e NPM
- Um servidor de banco de dados (ex: PostgreSQL)

### Passos de Instalação

1.  **Clone o repositório:**
    ```bash
    git clone [https://github.com/jthiagop/tumulos.git](https://github.com/jthiagop/tumulos.git)
    cd tumulos
    ```

2.  **Instale as dependências do PHP:**
    ```bash
    composer install
    ```

3.  **Instale as dependências do JavaScript:**
    ```bash
    npm install
    ```

4.  **Configure o arquivo de ambiente:**
    -   Copie o arquivo de exemplo:
        ```bash
        cp .env.example .env
        ```
    -   Gere a chave da aplicação:
        ```bash
        php artisan key:generate
        ```

5.  **Configure o banco de dados:**
    -   Abra o arquivo `.env` e edite as variáveis `DB_*` com as informações do seu banco de dados (nome do banco, usuário, senha).
    -   Certifique-se de ter criado o banco de dados no seu servidor.

6.  **Execute as Migrations e Seeders:**
    -   As migrations criarão as tabelas necessárias e os seeders (se existirem) popularão o banco com dados iniciais.
    ```bash
    php artisan migrate --seed
    ```

7.  **Compile os assets do frontend:**
    ```bash
    npm run dev
    ```

8.  **Inicie o servidor de desenvolvimento:**
    ```bash
    php artisan serve
    ```

Pronto! A aplicação estará rodando em `http://127.0.0.1:8000`.

---

## 🤝 Contribuições

Contribuições são o que tornam a comunidade de código aberto um lugar incrível para aprender, inspirar e criar. Qualquer contribuição que você fizer será **muito apreciada**.

Se você tiver uma sugestão para melhorar o projeto, por favor, crie um "fork" do repositório e abra um "pull request". Você também pode simplesmente abrir uma "issue" com a tag "melhoria".

1.  Faça um Fork do projeto
2.  Crie sua Feature Branch (`git checkout -b feature/AmazingFeature`)
3.  Faça o Commit de suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4.  Faça o Push para a Branch (`git push origin feature/AmazingFeature`)
5.  Abra um Pull Request

## 📄 Licença

Distribuído sob a licença MIT. Veja `LICENSE.txt` para mais informações.

O framework Laravel é um software de código aberto licenciado sob a [licença MIT](https://opensource.org/licenses/MIT).