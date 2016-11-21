<?php

if(!defined('MODX_BASE_PATH')) die('What are you doing? Get out of here!');

if ($useIcons=='yes') {
    $tabLabel_template  = '<i class="fa fa-newspaper-o"></i>';
    $tabLabel_tv        = '<i class="fa fa-list-alt"></i>';
    $tabLabel_chunk     = '<i class="fa fa-th-large"></i>';
    $tabLabel_snippet   = '<i class="fa fa-code"></i>';
    $tabLabel_plugin    = '<i class="fa fa-plug"></i>';
    $tabLabel_module    = '<i class="fa fa-cogs"></i>';
    $tabLabel_create    = '<i class="fa fa-plus"></i>';
    $tabLabel_refresh   = '<i class="fa fa-refresh"></i>';
}
else {
    $tabLabel_template  = 'TPL';
    $tabLabel_tv        = 'TV';
    $tabLabel_chunk     = 'CH';
    $tabLabel_snippet   = 'SN';
    $tabLabel_plugin    = 'PL';
    $tabLabel_module    = 'MD';
    $tabLabel_create    = 'Create';
    $tabLabel_refresh   = 'Refresh';
}

$text_reload_title = 'Click here to reload elements list.';

$tablePre = $modx->db->config['dbase'] . '.`' . $modx->db->config['table_prefix'];

$temp    = createElementsList('site_templates',16,$tablePre,'templatename');
$tv      = createElementsList('site_tmplvars',301,$tablePre);
$chunk   = createElementsList('site_htmlsnippets',78,$tablePre);
$snippet = createElementsList('site_snippets',22,$tablePre);
$plugin  = createElementsList('site_plugins',102,$tablePre);
$module  = createModulesList('site_modules',112,$tablePre);

if ( hasAnyPermission() ) {
    $output = '</div>';
}

if ($modx->hasPermission('edit_template')) {
    $output .= '
      <div class="tab-page" id="tabTemp" style="padding-left:0; padding-right:0;">
      <h2 class="tab" title="Templates">'.$tabLabel_template.'</h2>
      <script type="text/javascript">treePane.addTabPage( document.getElementById( "tabTemp" ) );</script>
      '.$temp.'
      <ul class="actionButtons actionButtons--eit">
      <li><a href="index.php?a=19" target="main" title="'.$_lang['new_template'].'">'.$tabLabel_create.'</a></li>
      <li><a href="javascript:reloadElementsInTree();" title="'.$text_reload_title.'">'.$tabLabel_refresh.'</a></li>
      </ul>
      </div>
    ';
}

if ($modx->hasPermission('edit_template')) {
    $output .= '
      <div class="tab-page" id="tabTV" style="padding-left:0; padding-right:0;">
      <h2 class="tab" title="Template Variables">'.$tabLabel_tv.'</h2>
      <script type="text/javascript">treePane.addTabPage( document.getElementById( "tabTV" ) );</script>
      '.$tv.'
      <ul class="actionButtons actionButtons--eit">
      <li><a href="index.php?a=300" target="main" title="'.$_lang['new_tmplvars'].'">'.$tabLabel_create.'</a></li>
      <li><a href="javascript:reloadElementsInTree();" title="'.$text_reload_title.'">'.$tabLabel_refresh.'</a></li>
      </ul>
      </div>
    ';
}

if ($modx->hasPermission('edit_chunk')) {
    $output .= '
      <div class="tab-page" id="tabCH" style="padding-left:0; padding-right:0;">
      <h2 class="tab" title="Chunks">'.$tabLabel_chunk.'</h2>
      <script type="text/javascript">treePane.addTabPage( document.getElementById( "tabCH" ) );</script>
      '.$chunk.'
      <ul class="actionButtons actionButtons--eit">
      <li><a href="index.php?a=77" target="main" title="'.$_lang['new_htmlsnippet'].'">'.$tabLabel_create.'</a></li>
      <li><a href="javascript:reloadElementsInTree();" title="'.$text_reload_title.'">'.$tabLabel_refresh.'</a></li>
      </ul>
      </div>
    ';
}

if ($modx->hasPermission('edit_snippet')) {
    $output .= '
      <div class="tab-page" id="tabSN" style="padding-left:0; padding-right:0;">
      <h2 class="tab" title="Snippets">'.$tabLabel_snippet.'</h2>
      <script type="text/javascript">treePane.addTabPage( document.getElementById( "tabSN" ) );</script>
      '.$snippet.'
      <ul class="actionButtons actionButtons--eit">
      <li><a href="index.php?a=23" target="main" title="'.$_lang['new_snippet'].'">'.$tabLabel_create.'</a></li>
      <li><a href="javascript:reloadElementsInTree();" title="'.$text_reload_title.'">'.$tabLabel_refresh.'</a></li>
      </ul>
      </div>
    ';
}

if ($modx->hasPermission('edit_plugin')) {
    $output .= '
      <div class="tab-page" id="tabPL" style="padding-left:0; padding-right:0;">
      <h2 class="tab" title="Plugins">'.$tabLabel_plugin.'</h2>
      <script type="text/javascript">treePane.addTabPage( document.getElementById( "tabPL" ) );</script>
      '.$plugin.'
      <ul class="actionButtons actionButtons--eit">
      <li><a href="index.php?a=101" target="main" title="'.$_lang['new_plugin'].'">'.$tabLabel_create.'</a></li>
      <li><a href="javascript:reloadElementsInTree();" title="'.$text_reload_title.'">'.$tabLabel_refresh.'</a></li>
      </ul>
      </div>
    ';
}

if ($modx->hasPermission('exec_module')) {
    
    $new_module_button = '';

    if ($modx->hasPermission('new_module')) {
        $new_module_button = '<li><a href="index.php?a=107" target="main" title="'.$_lang['new_module'].'">'.$tabLabel_create.'</a></li>';
    }
    
    $output .= '
      <div class="tab-page" id="tabMD" style="padding-left:0; padding-right:0;">
      <h2 class="tab" title="Modules">'.$tabLabel_module.'</h2>
      <script type="text/javascript">treePane.addTabPage( document.getElementById( "tabMD" ) );</script>
      '.$module.'
      <ul class="actionButtons actionButtons--eit">
      '.$new_module_button.'
      <li><a href="javascript:reloadElementsInTree();" title="'.$text_reload_title.'">'.$tabLabel_refresh.'</a></li>
      </ul>
      </div>
  ';
}

if ( hasAnyPermission() ) {
    
    $output .= '
    <script>
        jQuery(function() {
            var context = jQuery("#treePane").nuContextMenu({
              hideAfterClick: true,
              items: ".context-menu",
              callback: function(action, element) {
                var el = jQuery(element);
                var name = el.html();
                var cm = el.closest(".context-menu");
                eitAction(name, action, cm.data("type"), cm.data("id"));
              },
              menu: [
                { name: "create",    title: "'.addslashes($_lang["create_new"]).'", icon: "plus", },
                { name: "edit",      title: "'.addslashes($_lang["edit"]).'",       icon: "edit", },
                { name: "duplicate", title: "'.addslashes($_lang["duplicate"]).'",  icon: "clone", },
                { name: "void" },
                { name: "delete",    title: "'.addslashes($_lang["delete"]).'",     icon: "trash", },
              ]
            });
        });
        
        function eitAction(name, action, type, id) {
            var actionIds, deleteMsg;
            
            switch(type) {
                case "site_templates" :
                    actionsIds = { "create":19, "edit":16, "duplicate":96, "delete":21 }; 
                    deleteMsg = "'.addslashes($_lang["confirm_delete_template"]).'";
                    break;
                case "site_tmplvars" :
                    actionsIds = { "create":300, "edit":301, "duplicate":304, "delete":303 };
                    deleteMsg = "'.addslashes($_lang["confirm_delete_tmplvars"]).'";
                    break;
                case "site_htmlsnippets" :
                    actionsIds = { "create":77, "edit":78, "duplicate":97, "delete":80 };
                    deleteMsg = "'.addslashes($_lang["confirm_delete_htmlsnippet"]).'";
                    break;
                case "site_snippets" :
                    actionsIds = { "create":23, "edit":22, "duplicate":98, "delete":25 };
                    deleteMsg = "'.addslashes($_lang["confirm_delete_snippet"]).'";
                    break;
                case "site_plugins" :
                    actionsIds = { "create":101, "edit":102, "duplicate":105, "delete":104 };
                    deleteMsg = "'.addslashes($_lang["confirm_delete_plugin"]).'";
                    break;
                case "site_modules" :
                    actionsIds = { "create":107, "edit":108, "duplicate":111, "delete":110 };
                    deleteMsg = "'.addslashes($_lang["confirm_delete_module"]).'";
                    break;
                default :
                    alert("Unknown type");
                    return;
            }
            
            // Actions that need confirmation
            var confirmMsg = false;
            switch(action) {
                case "create" : id = false; break;
                case "edit" : break;
                case "duplicate" : confirmMsg = "'.addslashes($_lang["confirm_duplicate_record"]).'"; break;
                case "delete" : confirmMsg = deleteMsg; break;
            }
            
            if(confirmMsg) {
                confirmMsg += " \n \n " + name + " ("+id+")";
                var r = confirm(confirmMsg);
                if (r != true) return;
            }
            
            top.main.document.location.href="index.php?a="+actionsIds[action]+ (id ? "&id="+id : "");
        }
      </script>
    ';
    
    $output .= '</div>';
    $e->output($output);
}
