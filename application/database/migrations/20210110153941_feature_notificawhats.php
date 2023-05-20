<?php

class Migration_feature_notificawhats extends CI_Migration
{
    public function up()
    {
        $this->db->query('ALTER TABLE `configuracoes` CHANGE `valor` `valor` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL');
        $sql = "INSERT INTO `configuracoes` (`idConfig`, `config`, `valor`) VALUES ('7', 'notifica_whats', 'Estimado(a), *{CLIENTE_NOME}* con OS Nº *{NUMERO_OS}* ah cambiado el estado a: *{STATUS_OS}* con la siguiente Descripción: {DESCRI_PRODUTOS} con Valor Total de *{VALOR_OS}*!\\r\\nPara más información entre en contacto con Nosotros.\\r\\nAtte., *{EMITENTE} {TELEFONE_EMITENTE}*.')";
        $this->db->query($sql);
    }

    public function down()
    {
        $this->db->query("DELETE FROM `configuracoes` WHERE `configuracoes`.`idConfig` = 7");
        $this->db->query("ALTER TABLE `configuracoes` CHANGE `valor` `valor` VARCHAR(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;");
    }
}
