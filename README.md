# GestorMetatag
- O GestorMetatag é um modolo que realiza a inclusão de uma metatag em páginas CMS presentes em mais de uma loja/visão, esta metatag inclui o idioma da loja/visão atual e o caminho absoluto da página CMS como no medelo abaixo.
 <link rel="alternate" hreflang="pt_br" href="http://www.sualoja.com.br/about-us/" />.
 
## Especificações (Versão utilizada para desenvolvimento)
- Magento versão 2.3.4.

## Instalação
- Faça o download deste pacote na pasta "app/code/AndersonMorais" do seu projeto magento.
- Habilite o módulo executando `php bin/magento module:enable AndersonMorais_GestorMetatag`.
- Aplique as atualizações executando `php bin/magento setup:upgrade` e `php bin/magento setup:di:compile`.
- Limpe o cache executando `php bin/magento cache:flush`.

## Instruções Para Teste (Instalação padrão do magento 2.3.4 com tradução pt_br)
- Instale o modulo GestorMetatag seguindo as instruções de instalação acima.
- Efetue o login no painel administrativo.
- Navegue até "Lojas/Todas as Lojas".
- Crie novas lojas/visões e habilite as mesmas.
- Navegue até "Lojas/Configurações".
- Selecione o escopos das lojas/visões e altere as localidades em "Opções de localidade" para cada idioma.
- Por padrão as páginas CMS aparecerão em todos os idiomas, caso queira testar com alguns idiomas específicos navegue até "Conteúdo/Páginas" 
   e selecione uma página para teste como por exemplo "About us" e clique em Editar.
- Em "Página nos Sites" selecione apenas algumas lojas/visões para teste, depois salve a alteração.
- Agora basta limpar o cache e acessar a página no navegador.
- Para poder visualizar a alteração no código, abra o projeto em uma página CMS e clique com o botão direito do mouse em "Inspecionar".
- A metatag devera aparecer ou não dentro da tag Head.
