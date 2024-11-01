---

# Formulário de Cadastro com Integração AJAX

Este projeto fornece uma interface web para selecionar e carregar formulários de cadastro de Pessoa Física (PF) e Pessoa Jurídica (PJ) com a funcionalidade de carregamento dinâmico usando AJAX. É uma solução ideal para aplicações que requerem integração com APIs externas, como o sistema de gerenciamento SGP.

## Funcionalidades

- **Carregamento Dinâmico com AJAX**: Permite que o usuário alterne entre formulários de Pessoa Física e Pessoa Jurídica sem recarregar a página inteira.
- **Redirecionamento Alternativo**: Possui uma versão alternativa que redireciona o usuário para a página de cadastro correspondente ao selecionar a opção no menu.
- **Mensagens de Erro**: Inclui tratamento de erros com mensagens personalizadas para falhas no carregamento dos formulários.

## Estrutura do Projeto

- `assinar.php`: Página principal onde os usuários podem selecionar o tipo de cadastro.
- `form-assinatura_pf.php`: Formulário de cadastro para Pessoa Física.
- `form-assinatura_pj.php`: Formulário de cadastro para Pessoa Jurídica.

## Configuração Inicial

Antes de utilizar o projeto, é **necessário definir as variáveis constantes** nos arquivos `form-assinatura_pf.php` e `form-assinatura_pj.php` com as informações de integração da API do SGP.

### Variáveis a serem configuradas

Adicione as constantes abaixo nos arquivos `form-assinatura_pf.php` e `form-assinatura_pj.php`:

```php
define("URL_SGP", "URL_DO_SEU_SGP"); // Ex: https://seuprovedor.sgp.net.br
define("TOKEN_SGP", "SEUTOKEN"); // Seu TOKEN de integração com a API, disponível no menu do SGP em -> Administração -> Integrações -> Tokens
define("APP_SGP", "SEU_APP"); // Nome do APP criado no SGP, disponível em -> Administração -> Integrações -> Tokens
```

### Como definir as constantes

1. **URL_SGP**: Coloque a URL base do seu SGP, por exemplo, `https://seuprovedor.sgp.net.br`.
2. **TOKEN_SGP**: Insira o token de integração gerado no painel do SGP (Acesse: *Administração* > *Integrações* > *Tokens*).
3. **APP_SGP**: O nome do aplicativo criado no SGP (disponível na mesma seção dos tokens).

## Como Executar

1. Clone este repositório em seu ambiente local:
   ```bash
   git clone https://github.com/seuusuario/seurepositorio.git
   ```
2. Edite os arquivos `form-assinatura_pf.php` e `form-assinatura_pj.php` para incluir as variáveis de configuração mencionadas.
3. Abra `assinar.php` em um navegador e interaja com a interface para selecionar o tipo de cadastro e carregar o formulário correspondente.

## Dependências

- [Bootstrap 5.3.0](https://getbootstrap.com/)
- [jQuery 3.6.0](https://jquery.com/)

## Problemas Conhecidos

- **Erro de carregamento**: Caso a URL de integração ou o token estejam incorretos, o formulário pode falhar ao carregar, exibindo uma mensagem de erro.

## Suporte

Se você encontrar problemas ou tiver dúvidas, sinta-se à vontade para abrir uma *issue* neste repositório ou entrar em contato.

---
