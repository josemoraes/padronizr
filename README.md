# Extrator

Essa aplicação tem o objetivo de otimizar o processo de download e nomeação de arquivos de imagens, pois esse é um processo demorado quando se está realizando a importação de um catálogo de produtos por planilha. Logo, a ideia é nomear as imagens com base no identificador do produto (SKU).

PREMISSAS
1. Ler o arquivo;
2. Baixar as imagens;
3. Renomear as imagens;

RESTRIÇÕES
1. O arquivo deve ter as colunas `sku` e `images`, na célula da imagem as URLs devem ser separadas por pipe;