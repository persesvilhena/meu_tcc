<div class="card text-secondary border-secondary mb-3">
    <div class="card-header"><h3>Informações Principais</h3></div>
    <div class="card-body">
        <b>Quantidade de registros no banco de dados: </b><?= $this->conf->qtde_registros(); ?><br>
        <b>Quantidade de análises realizadas: </b><?= $this->conf->qtde_analises(); ?><br>
        <b>Quantidade de campus associados: </b><?= $this->conf->qtde_campus(); ?><br>
        <b>Quantidade de usuários da ferramenta: </b><?= $this->conf->qtde_usuarios(); ?><br>
    </div>
</div>

<div class="card text-secondary border-secondary mb-3">
    <div class="card-header"><h3>Sobre a ferramenta</h3></div>
    <div class="card-body">
        Esta ferramenta Web móvel tem como objetivo automatizar o processo de analisar dados socioeconômicos dos candidatos ao vestibular do IFSULDEMINAS para a obtenção de conhecimento acerca do perfil dos candidatos, comparando o resultado atual com os resultados de análises realizadas em anos e semestres anteriores.
    </div>
</div>

<div class="card text-secondary border-secondary mb-3">
    <div class="card-header"><h3>Como utilizar a ferramenta</h3></div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5>Elementos da ferramenta</h5>
                <img src="<?= base_url(); ?>assets/imgs/tutorial/elementos.png" class="rounded img-fluid">
            </div>
            <div class="col-md-6">
                <br>
                <b>1.</b> Menu principal da ferramenta.<br>
                <b>2.</b> Menu de acesso as configurações do perfil e para sair da ferramenta.<br>
                <b>3.</b> Area de operação da ferramenta.<br>
            </div>
        </div>
        <hr>

        <!--

        <div class="row">
            <div class="col-md-6">
                <h5>Alimentação da base de dados</h5>
                <img src="<?= base_url(); ?>assets/imgs/tutorial/alimentacao.png" class="rounded img-fluid">
            </div>
            <div class="col-md-6">
                <br>
                <b>1.</b> Item no menu para acesso a seção de alimentação de dados.<br>
                <b>2.</b> Opção para escolher entre inserir novos dados ou trabalhar com dados já existentes.<br>
            </div>
        </div>
        <hr>



        <div class="row">
            <div class="col-md-6">
                <h5>Inserindo novos dados</h5>
                <img src="<?= base_url(); ?>assets/imgs/tutorial/alimentacao1.png" class="rounded img-fluid">
            </div>
            <div class="col-md-6">
                <br>
                <b>1.</b> Area para selecionar o arquivo CSV a ser inserido com combo onde é possível informar de qual campus o arquivo CSV é pertencente, a barra de progresso do upload e botão para iniciar o processo de upload.<br>
                <b>2.</b> Realiza o processo de extração das informações do arquivo CSV para dentro do banco de dados.<br>
            </div>
        </div>
        <hr>



        <div class="row">
            <div class="col-md-6">
                <h5>Processo de limpeza</h5>
                <img src="<?= base_url(); ?>assets/imgs/tutorial/limpeza.png" class="rounded img-fluid">
            </div>
            <div class="col-md-6">
                <br>
                <b>1.</b> Acesso a página onde é possível escolher quais os valores distintos aceitos pela ferramenta.<br>
                <b>2.</b> Onde é realizado o processo de limpeza de dados.<br>
            </div>
        </div>
        <hr>




        <div class="row">
            <div class="col-md-6">
                <h5>Valores distintos</h5>
                <img src="<?= base_url(); ?>assets/imgs/tutorial/tipos.png" class="rounded img-fluid">
            </div>
            <div class="col-md-6">
                <br>
                <b>1.</b> Formulário com os valores distintos que cada coluna deve possuir.<br>
            </div>
        </div>
        <hr>-->



        <div class="row">
            <div class="col-md-6">
                <h5>Realização da análise</h5>
                <img src="<?= base_url(); ?>assets/imgs/tutorial/analise.png" class="rounded img-fluid">
            </div>
            <div class="col-md-6">
                <br>
                <b>1.</b> Item no menu para acesso a seção de análise dos dados.<br>
                <b>2.</b> Seletor onde é possível escolher qual ou quais editais serão usados no processo de mineração de dados (itens para a direita estão selecionados e itens para esquerda não estão selecionados).<br>
                <b>3.</b> Seletor onde é possível escolher qual ou quais campus serão usados no processo de mineração de dados (itens para a direita estão selecionados e itens para esquerda não estão selecionados).<br>
                <b>4.</b> Processo onde é feita a mineração de dados em si.<br>
            </div>
        </div>
        <hr>





        <!--<div class="row">
            <div class="col-md-6">
                <h5>Configurações gerais</h5>
                <img src="<?= base_url(); ?>assets/imgs/tutorial/config.png" class="rounded img-fluid">
            </div>
            <div class="col-md-6">
                <br>
                <b>1.</b> Item no menu para acesso a seção de configurações gerais.<br>
                <b>2.</b> Configurações gerais e botão para salvar.<br>
                <b>3.</b> Seção resposável por limpar a base de dados e informar a quantidade de registros.<br>
            </div>
        </div>
        <hr>-->




        <div class="row">
            <div class="col-md-6">
                <h5>Visualização das regras de associação extraídas</h5>
                <img src="<?= base_url(); ?>assets/imgs/tutorial/ver-analises.png" class="rounded img-fluid">
            </div>
            <div class="col-md-6">
                <br>
                <b>1.</b> Item no menu para acesso a seção de visualização das regras.<br>
                <b>2.</b> Análises realizadas e suas respectivas datas.<br>
                <b>3.</b> Operações de visualização da regra e apagar a regras de suas respectivas análises.<br>
            </div>
        </div>
        <hr>




        <div class="row">
            <div class="col-md-6">
                <h5>Configurações do algoritmo Apriori</h5>
                <img src="<?= base_url(); ?>assets/imgs/tutorial/config_apriori.png" class="rounded img-fluid">
            </div>
            <div class="col-md-6">
                <br>
                <b>1.</b> Item no menu para acesso a seção de configurações do algoritmo Apriori.<br>
                <b>2.</b> Configurações do algoritmo Apriori.<br>
                <b>3.</b> Botão para mostrar as configurações avançadas.<br>
                <b>4.</b> Botão para salvar as configurações.<br>
            </div>
        </div>
        <hr>




        <div class="row">
            <div class="col-md-6">
                <h5>Perfil</h5>
                <img src="<?= base_url(); ?>assets/imgs/tutorial/perfil.png" class="rounded img-fluid">
            </div>
            <div class="col-md-6">
                <br>
                <b>1.</b> Item no menu para acesso ao perfil.<br>
                <b>2.</b> Formulário com os dados do usuário.<br>
                <b>3.</b> Botão para salvar.<br>
            </div>
        </div>
        <hr>


        


        
    </div>
</div>