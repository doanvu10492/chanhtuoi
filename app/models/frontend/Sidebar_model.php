<?php
class Sidebar_model extends My_Model 
{ 
    public function __construct()
    {
        parent::__construct();

        $this->table_album = TB_ALBUM;
        $this->category_album = TB_CGR_ALBUM;
        $this->table_video = TB_VIDEO;
        $this->table_links = TB_LINKS;
        $this->table_posts= TB_POSTS;
        $this->category_posts = TB_CGR_POSTS;
    }

    public function socialNetworks()
    {
        //social network top
        $social_network_ft = '';
        $social_network_ft .='<div class="social-network-ft">';

        $social_network_ft .= ($this->config->item('twitter') != null) ? ('<a href="'.$this->config->item('twitter').'" class="fa fa-twitter bounceInLeft  wow  animated" data-wow-delay="0.4s" data-wow-duration="2s"></a>') : ('');

        $social_network_ft .= ($this->config->item('facebook') != null) ? ('<a href="'.$this->config->item('facebook').'" class="fa fa-facebook bounceInLeft  wow  animated" data-wow-delay="0.4s" data-wow-duration="2s"></a>') : ('');

        $social_network_ft .= ($this->config->item('instagram') != null) ? ('<a href="'.$this->config->item('instagram').'" class="fa fa-linkedin bounceInLeft  wow  animated" data-wow-delay="0.4s" data-wow-duration="2s"></a>') : ('');

        $social_network_ft .= ($this->config->item('google') != null) ? ('<a href="'.$this->config->item('google').'" class="fa fa-google-plus bounceInLeft  wow  animated" data-wow-delay="0.2s" data-wow-duration="2s"></a>') : ('');

        $social_network_ft .= ($this->config->item('pinterest') != null) ? ('<a href="'.$this->config->item('pinterest').'" class="fa fa-pinterest-p bounceInLeft  wow  animated" data-wow-delay="0.2s" data-wow-duration="2s"></a>') : ('');

        $social_network_ft .='</div>';

        return $social_network_ft;
    }

    public function check_parent($id_parent)
    {
        $this->db->where('id_parent', $id_parent);
        $this->db->select('*');
        $result = $this->db->get(TB_CGR_POSTS)->result_array();
        
        if(count($result) > 0)
            return true;
        else 
            return false;
    }

    public function checkParentMenu($id_parent)
    {
        $this->db->where('id_parent', $id_parent);
        $this->db->select('*');
        $result = $this->db->get(TB_MENU)->result_array();
        if(count($result) > 0)
            return true;
        else 
            return false;
    }

    public function menuMain($id_parent = 0, $lang = null, $alias = '')
    {
        $this->db->select("
                name{$lang} as name, 
                icon, 
                icon_hover,
                link{$lang} as link, 
                id, 
                alias{$lang} as alias, 
                id_parent"
            )->where([
                'active' => 1, 
                'id_parent' => $id_parent]
            )->order_by('ordering asc');

        $result = $this->db->get(TB_MENU)->result_array();
        $data = array();

        if (count($result) > 0) {
            foreach ($result as $row) {
                if ($this->checkParentMenu($row['id'])) {
                     $row['child'] = $this->menuMain($row['id'], $lang, $row['alias']);  
                }
                $data[]= $row;     
            }
        }

        return $data;
    }

    public function supportOnline($lang)
    {
        $this->db->where('active', 1);
        $this->db->order_by('ordering asc');
        $this->db->select("name{$lang} as name, hotline, skype, email");
        $result = $this->db->get(TB_SUPPORT_ONLINE)->result_array();

        return $result;
    }

    public function slider($lang= "")
    {
        $this->db->where('active', 1);
        $this->db->order_by('ordering asc');
        $this->db->select("name{$lang} as name, brief{$lang} as brief, link{$lang} as link, image, link2, link3");
        $result = $this->db->get(TB_SLIDE)->result_array();
        
        return $result;    
    }
}