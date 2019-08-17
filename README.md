# Sistema de participação restrita
Esta aplicação permite a criação de consultas restritas de projetos urbanísticos.
[Visão geral do sistema](https://www.figma.com/file/ljCmj2YYsXSdq04hujV2UC/Participe-Blocos-desfiles-carnaval-2020?node-id=1%3A7)

## Estrutura da aplicação
Se divide em três diretórios. `api/`, `app` e `admin`.

### api/
Contém os serviços necessários para esta aplicação. Deve ser publicado em produção.

### app/
Frontend do munícipe onde ocorre a autenticação e participação. Também deve ser publicado em ambiente de produção. 

### admin/
Frontend do servidor que controla os acessos e consome serviços específicos como o envio de emails. Deve ser publicado na **intranet** (spurbsp163).
