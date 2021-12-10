<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $caixa = (isset($_POST["caixa"]) && $_POST["caixa"] != null) ? $_POST["caixa"] : "";
    $id_cli = (isset($_POST["id_cli"]) && $_POST["id_cli"] != null) ? $_POST["id_cli"] : "";
    $id_unidade = (isset($_POST["id_unidade"]) && $_POST["id_unidade"] != null) ? $_POST["id_unidade"] : "";
	$id_armario = (isset($_POST["id_armario"]) && $_POST["id_armario"] != null) ? $_POST["id_armario"] : "";
} else if (!isset($id)) {
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $caixa = NULL;
    $id_cli = NULL;
    $id_unidade = NULL;
	$id_armario = NULL;
}
 
try {
    $conexao = new PDO("mysql:host=localhost;dbname=arquivo", "root", "");
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("set names utf8");
} catch (PDOException $erro) {
    echo "Erro na conexão:".$erro->getMessage();
}
 
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $id_cli != "") {
    try {
        if ($id != "") {
            $stmt = $conexao->prepare("UPDATE armazenamento SET caixa=?, id_cli=?, id_unidade=?, id_armario=? WHERE id = ?");
            $stmt->bindParam(5, $id);
        } else {
            $stmt = $conexao->prepare("INSERT INTO armazenamento (caixa, id_cli, id_unidade, id_armario) VALUES (?, ?, ?, ?)");
        }
        $stmt->bindParam(1, $caixa);
        $stmt->bindParam(2, $id_cli);
        $stmt->bindParam(3, $id_unidade);
		$stmt->bindParam(4, $id_armario);
 
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
				echo "<a href='#abrirModal'/>";
                $id = null;
                $caixa = null;
                $id_cli = null;
                $id_unidade = null;
				$id_armario = null;
            } else {
                echo "Erro ao tentar efetivar cadastro";
            }
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    try {
        $stmt = $conexao->prepare("DELETE FROM armazenamento WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo "";
            $id = null;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
	<meta charset="UTF-8">
	<title>.  PROJETO - ARMAZENAMENTO    .  </title>
	<link rel="stylesheet" type="text/css" href="../Estilos/css.css"></link>
<script language="JavaScript">
 var repeat=1
 var title=document.title
 var leng=title.length
 var start=1
 function titlemove() {
 titl=title.substring(start, leng) + title.substring(0, start)
 document.title=titl
 start++
 if (start==leng+1) {
 start=0
 if (repeat==0)
 return
 }
 setTimeout("titlemove()",240)
 }
 if (document.title)
 titlemove()
</script>
    </head>
    <body bgcolor="black">
	
	<div class="pagina_geral">
        <form action="?act=save" method="POST" name="form1" >
            <div class="estilo_1" align="center">Sistema de Armazenamento de Caixas</div>
			

	<div class="quadrado2">
	<div class="quadrado3">
	<div class="apresentacao"></div>
            <input type="hidden"	 name="id" <?php
            
            if (isset($id) && $id != null || $id != "") {
                echo "value=\"{$id}\"";
            }
            ?> />
            <div class="estilo_2" align="right">Caixa:</div>
            <input type="text" name="caixa" class="estilo_4" maxlength="12"
			<?php
            if (isset($caixa) && $caixa != null || $caixa != ""){
                echo "value=\"{$caixa}\"";
            }
            ?> />
			
            <div class="estilo_2" align="right">Cliente:</div>
            <select class="estilo_3" name="id_cli">
			<option>Selecione</option>
			<option value="1" <?php
					if (isset($id_cli) && $id_cli != null || $id_cli != ""){
						echo "value=\"{$id_cli}\"";
					}
				?>>CAIXAS DE PAPELAO PONTO COM</option>
			<option value="2" <?php
					if (isset($id_cli) && $id_cli != null || $id_cli != ""){
						echo "value=\"{$id_cli}\"";
					}
				?>>CAIXOTES E CIA
			</option>
			<option value="3" <?php
					if (isset($id_cli) && $id_cli != null || $id_cli != ""){
						echo "value=\"{$id_cli}\"";
					}
				?>>COMERCIO DE EQUIPAMENTOS
			</option>
			<option value="4" <?php
					if (isset($id_cli) && $id_cli != null || $id_cli != ""){
						echo "value=\"{$id_cli}\"";
					}
				?>>DOCUMENTOS DE CARROS IMPORTADOS
			</option>
			<option value="5" <?php
					if (isset($id_cli) && $id_cli != null || $id_cli != ""){
						echo "value=\"{$id_cli}\"";
					}
				?>>HOSPITAL DO POVO BRASILEIRO
			</option>
			<option value="6" <?php
					if (isset($id_cli) && $id_cli != null || $id_cli != ""){
						echo "value=\"{$id_cli}\"";
					}
				?>>INDUSTRIA DE EMBALAGENS
			</option>
			<option value="7" <?php
					if (isset($id_cli) && $id_cli != null || $id_cli != ""){
						echo "value=\"{$id_cli}\"";
					}
				?>>PAPELARIA DAS COLINAS
			</option>
			<option value="8" <?php
					if (isset($id_cli) && $id_cli != null || $id_cli != ""){
						echo "value=\"{$id_cli}\"";
					}
				?>>REMEDIOS EMBALADOS
			</option>
			<option value="9" <?php
					if (isset($id_cli) && $id_cli != null || $id_cli != ""){
						echo "value=\"{$id_cli}\"";
					}
				?>>RH DE QUALIDADE
			</option>
			<option value="10" <?php
					if (isset($id_cli) && $id_cli != null || $id_cli != ""){
						echo "value=\"{$id_cli}\"";
					}
				?>>SACOLAS E PAPELOES
			</option>
	</select>

            <div class="estilo_2" align="right">Unidade:</div>
		<select class="estilo_3" name="id_unidade">
			<option>Selecione</option>
			<option value="1" <?php	
					if (isset($id_unidade) && $id_unidade != null || $id_unidade != ""){
					echo "value=\"{$id_unidade}\"";
					}
				?>>SÃO PAULO – CENTRO</option>
			<option value="2" <?php
					if (isset($id_unidade) && $id_unidade != null || $id_unidade != ""){
					echo "value=\"{$id_unidade}\"";
					}
				?>>SÃO PAULO – INTERIOR
			</option>
			<option value="3" <?php
					if (isset($id_unidade) && $id_unidade != null || $id_unidade != ""){
					echo "value=\"{$id_unidade}\"";
					}
				?>>SÃO PAULO – ZONA NORTE
			</option>
			<option value="4" <?php
					if (isset($id_unidade) && $id_unidade != null || $id_unidade != ""){
					echo "value=\"{$id_unidade}\"";
					}
				?>>MINAS GERAIS – CENTRO
			</option>
			<option value="5" <?php	
					if (isset($id_unidade) && $id_unidade != null || $id_unidade != ""){
					echo "value=\"{$id_unidade}\"";
					}
				?>>MINAS GERAIS – SUL
			</option>
			<option value="6" <?php
					if (isset($id_unidade) && $id_unidade != null || $id_unidade != ""){
					echo "value=\"{$id_unidade}\"";
					}
				?>>CURITIBA – CENTRO
			</option>
			<option value="7" <?php
					if (isset($id_unidade) && $id_unidade != null || $id_unidade != ""){
					echo "value=\"{$id_unidade}\"";
					}
				?>>RIO GRANDE DO SUL – NORTE
			</option>
			<option value="8" <?php
					if (isset($id_unidade) && $id_unidade != null || $id_unidade != ""){
					echo "value=\"{$id_unidade}\"";
					}
				?>>RIO DE JANEIRO – CENTRO-OESTE
			</option>
			<option value="9" <?php
					if (isset($id_unidade) && $id_unidade != null || $id_unidade != ""){
					echo "value=\"{$id_unidade}\"";
					}
				?>>BAHIA – CENTRO
			</option>
			<option value="10"<?php
					if (isset($id_unidade) && $id_unidade != null || $id_unidade != ""){
					echo "value=\"{$id_unidade}\"";
					}
				?>>AMAZONAS – CENTRO-NORTE
			</option>
		</select>
		
            <div class="estilo_2" align="right">Local de Armazenagem:</div>
		<select class="estilo_3" name="id_armario">
			<option>Selecione</option>
			<option value="1" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00001</option>
				<option value="2" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00002</option>
				<option value="3" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00003</option>
				<option value="4" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00004</option>
				<option value="5" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00005</option>
				<option value="6" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00006</option>
				<option value="7" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00007</option>
				<option value="8" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00008</option>
				<option value="9" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00009</option>
				<option value="10" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00010</option>
				<option value="11" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00011</option>
				<option value="12" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00012</option>
				<option value="13" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00013</option>
				<option value="14" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00014</option>
				<option value="15" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00015</option>
				<option value="16" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-000016</option>
				<option value="17" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-000017</option>
				<option value="18" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00018</option>
				<option value="19" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00019</option>
				<option value="20" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00020</option>
				<option value="21" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00021</option>
				<option value="22" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00022</option>
				<option value="23" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00023</option>
				<option value="24" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00024</option>
				<option value="25" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00025</option>
				<option value="26" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00026</option>
				<option value="27" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00027</option>
				<option value="28" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00028</option>
				<option value="29" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00029</option>
				<option value="30" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00030</option>
				<option value="31" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00031</option>
				<option value="32" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00032</option>
				<option value="33" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00033</option>
				<option value="34" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00034</option>
				<option value="35" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00035</option>
				<option value="36" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00036</option>
				<option value="37" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00037</option>
				<option value="38" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00038</option>
				<option value="39" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00039</option>
				<option value="40" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00040</option>
				<option value="41" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00041</option>
				<option value="42" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00042</option>
				<option value="43" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00043</option>
				<option value="44" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00044</option>
				<option value="45" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00045</option>
				<option value="46" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00046</option>
				<option value="47" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00047</option>
				<option value="48" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00048</option>
				<option value="49" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00049</option>
				<option value="50" <?php
					if (isset($id_armario) && $id_armario != null || $id_armario != ""){
					echo "value=\"{$id_armario}\"";
				}
				?>>PRA-00050</option>				
		</select>
	</div>
	
           <input type="submit" value="ARQUIVAR" class="btn_salvar"/>
           <input type="reset" value="LIMPAR" class="btn_limpar" aling="center" />
        </form>
		
		<div class="titulo" align="center">TABELA DE CAIXAS</div>
		
<table class="tabela1">
	<tr>
		<th class="tabela2">Caixa</th>
		<th class="tabela2">Cliente</th>
		<th class="tabela2">Unidade</th>
		<th class="tabela2">Localização</th>
		<th class="tabela2">Ações</th>
		<th class="tabela2">Modelo da Caixa</th>
		</tr>
		
<?php
                try {
                    $stmt = $conexao->prepare("SELECT armazenamento.id, armazenamento.caixa, CLIENTES1.nome_cli, unidade.nome_unidade, armario.nome_arm FROM arquivo.armazenamento INNER JOIN CLIENTES1 ON armazenamento.id_cli = CLIENTES1.ID INNER JOIN unidade ON armazenamento.id_unidade = unidade.ID INNER JOIN armario ON armazenamento.id_armario = armario.ID;");
                    if ($stmt->execute()) {
                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                            echo "<tr>";
                            echo "<td class='tabela3' align='center'>".$rs->caixa."</td>
							<td class='tabela3'align='center'>".$rs->nome_cli."</td>
							<td class='tabela3'align='center'>".$rs->nome_unidade."</td>
							<td class='tabela3'align='center'>".$rs->nome_arm."</td>
							<td class='tabela3'><center><a href=\"?act=del&id="
								.$rs->id."\">[Retirar Caixa]</a></center>"."</td>".
							"<td class='tabela4'>".
								"<div class='caixa'>".
										"<div class='caixa_dentro1' align='center'>".$rs->caixa."</div>".
										"<div class='caixa_dentro3'>"."</div>".
										"<div class='caixa_dentro2' align='center'>"."P"."</div>".
										"<div class='caixa_dentro4' align='center'>".$rs->nome_cli."</div>".
								"</div>".
							"</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                    }
                } catch (PDOException $erro) {
                    echo "Erro: ".$erro->getMessage();
                }
?>

							
</table>	
	
	</div>

	<div class="quadrado1" align="center">Copyright © 2021 - Todos os direitos reservados</div>
	
	<hr color="white" width="10px">
	
	</div>
    </body>
</html>