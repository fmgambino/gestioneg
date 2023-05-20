<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Permission Class
 *
 * Biblioteca para controle de Persimos/Roles
 *
 * @author      Electronica Gambino
 * @copyright   Copyright (c) 2013, Electronica Gambino.
 * @since       Version 1.0
 * v... Visualizar
 * e... Editar
 * d... Deletar ou Desabilitar
 * c... Cadastrar
 */

class Permission
{
    private $permissions = [];
    private $table = 'permissoes'; //Nome tabela onde ficam armazenadas as Persimos/Roles
    private $pk = 'idPermissao'; // Nome da chave primaria da tabela
    private $select = 'permissoes'; // Campo onde fica o array de permissoes.

    public function __construct()
    {
        log_message('debug', "Permission Class Initialized");
        $this->CI = &get_instance();
        $this->CI->load->database();
    }

    public function checkPermission($idPermissao = null, $atividade = null)
    {
        if ($idPermissao == null || $atividade == null) {
            return false;
        }
        // Se as Persimos/Roles não estiverem carregadas, requisita o carregamento
        if ($this->permissions == null) {
            // Se não carregar retorna falso
            if (!$this->loadPermission($idPermissao)) {
                return false;
            }
        }

        if (is_array($this->permissions[0])) {
            if (array_key_exists($atividade, $this->permissions[0])) {
                // compara a atividade requisitada com a permissão.
                if ($this->permissions[0][$atividade] == 1) {
                    return true;
                }
            }
        }
        return false;
    }

    private function loadPermission($id = null)
    {
        if ($id != null) {
            $this->CI->db->select($this->table . '.' . $this->select);
            $this->CI->db->where($this->pk, $id);
            $this->CI->db->limit(1);
            $array = $this->CI->db->get($this->table)->row_array();

            if (count($array) > 0) {
                $array = unserialize($array[$this->select]);
                //Atribui as permissoes ao atributo permissions
                $this->permissions = [$array];
                return true;
            }
        }
        return false;
    }
}
