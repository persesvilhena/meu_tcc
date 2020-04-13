<?php
$config = json_decode($this->conf->user()->apriori);
$regra = $config->car ." ". $config->outputItemSets ." ". $config->removeAllMissingCols ." ". $config->treatZeroAsMissing ." ". $config->verbose; 

$regra .= " -c ".$config->classIndex." -D ".$config->delta." -T ".$config->metricType." -C ".$config->minMetric." -N ".$config->minRules." -S ".$config->significanceLevel." -U ".$config->upperBoundMinSupport." -M ".$config->lowerBoundMinSupport;

//echo $regra;
?>

<?= $this->conf->get_alertas(); ?>
<form action="" method="post">
    <div class="card text-secondary border-secondary mb-3">
        <div class="card-header"><h3>Configurações Algoritmo Apriori</h3></div>
        <div class="card-body">
            <div class="row">
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Quantidade de regras:
                        <small>O número requerido de regras (padrão = 10)</small>
                        </label>
                        <input type="text" class="form-control" name="minRules" value="<?= $config->minRules; ?>">
                    </div>

                    <div class="form-group">
                        <label>Confiança:
                            <small>A confiança mínima de uma regra (padrão = 0.9)</small>
                        </label>
                        <input type="text" class="form-control" name="minMetric" value="<?= $config->minMetric; ?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Suporte:
                            <small>O limite inferior para o suporte mínimo (padrão = 0.1)</small>
                        </label>
                        <input type="text" class="form-control" name="lowerBoundMinSupport" value="<?= $config->lowerBoundMinSupport; ?>">
                    </div>

                    <div class="form-group">
                        <label>Mostrar configurações avançadas:</label><br>
                        <a href="#" onclick="document.getElementById('hd').style.display = '';" class="btn btn-outline-success">Mostrar configurações avançadas</a>
                    </div>
                </div>
            </div>

            <div class="row" id="hd" style="display: none;">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>car
                            <small>Se ativado, as regras de associação de classe são mineradas em vez de regras de associação (gerais)</small>
                        </label>
                        <select class="form-control" name="car">
                            <?php if($config->car){
                                echo "<option value=\"-A\" selected>True</option>";
                                echo "<option value=\"\">False</option>";
                            }else{
                                echo "<option value=\"-A\">True</option>";
                                echo "<option value=\"\" selected>False</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>classIndex
                            <small>O índice de classe (padrão = último)</small>
                        </label>
                        <input type="text" class="form-control" name="classIndex" value="<?= $config->classIndex; ?>">
                    </div>

                    <div class="form-group">
                        <label>delta 
                            <small>Diminuir iterativamente o suporte por este fator</small></label>
                        <input type="text" class="form-control" name="delta" value="<?= $config->delta; ?>">
                    </div>

                    <div class="form-group">
                        <label>metricType
                            <small>Define o tipo de métrica pelo qual classificar as regras</small>
                        </label>
                        <select class="form-control" name="metricType">
                            <?php $mt[0] = $mt[1] = $mt[2] = $mt[3] = "";
                            $mt[$config->metricType] = "selected"; ?>
                            <option value="0" <?= $mt[0]; ?>>Confidence</option>
                            <option value="1" <?= $mt[1]; ?>>Lift</option>
                            <option value="2" <?= $mt[2]; ?>>Leverage</option>
                            <option value="3" <?= $mt[3]; ?>>Conviction</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>upperBoundMinSupport
                            <small>Limite superior para suporte mínimo</small>
                        </label>
                        <input type="text" class="form-control" name="upperBoundMinSupport" value="<?= $config->upperBoundMinSupport; ?>">
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>outputItemSets
                            <small>Se ativado, os conjuntos de itens também serão exibidos</small>
                        </label>
                        <select class="form-control" name="outputItemSets">
                            <?php if($config->outputItemSets){
                                echo "<option value=\"-I\" selected>True</option>";
                                echo "<option value=\"\">False</option>";
                            }else{
                                echo "<option value=\"-I\">True</option>";
                                echo "<option value=\"\" selected>False</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>removeAllMissingCols
                            <small>Remover colunas com todos os valores ausentes</small>
                        </label>
                        <select class="form-control" name="removeAllMissingCols">
                            <?php if($config->removeAllMissingCols){
                                echo "<option value=\"-R\" selected>True</option>";
                                echo "<option value=\"\">False</option>";
                            }else{
                                echo "<option value=\"-R\">True</option>";
                                echo "<option value=\"\" selected>False</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>significanceLevel
                            <small>Nível de significância</small>
                        </label>
                        <input type="text" class="form-control" name="significanceLevel" value="<?= $config->significanceLevel; ?>">
                    </div>

                    
                    <div class="form-group">
                        <label>treatZeroAsMissing
                            <small>Se ativado, zero (ou seja, o primeiro valor de um valor nominal) é tratado da mesma maneira que um valor ausente</small>
                        </label>
                        <select class="form-control" name="treatZeroAsMissing">
                            <?php if($config->treatZeroAsMissing){
                                echo "<option value=\"-Z\" selected>True</option>";
                                echo "<option value=\"\">False</option>";
                            }else{
                                echo "<option value=\"-Z\">True</option>";
                                echo "<option value=\"\" selected>False</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>verbose
                            <small>Se ativado, o algoritmo será executado no modo detalhado</small>
                        </label>
                        <select class="form-control" name="verbose">
                            <?php if($config->verbose){
                                echo "<option value=\"-V\" selected>True</option>";
                                echo "<option value=\"\">False</option>";
                            }else{
                                echo "<option value=\"-V\">True</option>";
                                echo "<option value=\"\" selected>False</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
                


            
            <div style="float: right;">
                <input type="submit" class="btn btn-outline-success" name="enviar" value="Salvar">
            </div>
        </div>
    </div>
    
    
</form>