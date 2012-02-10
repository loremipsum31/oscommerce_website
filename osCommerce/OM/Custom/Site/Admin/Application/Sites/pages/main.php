<?php
/**
 * osCommerce Online Merchant
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  use osCommerce\OM\Core\HTML;
  use osCommerce\OM\Core\OSCOM;
?>

<h1><?php echo $OSCOM_Template->getIcon(32) . HTML::link(OSCOM::getLink(), $OSCOM_Template->getPageTitle()); ?></h1>

<?php
  if ( $OSCOM_MessageStack->exists() ) {
    echo $OSCOM_MessageStack->get();
  }
?>

<form id="liveSearchForm">
  <?php echo HTML::inputField('search', null, 'id="liveSearchField" class="searchField" placeholder="' . OSCOM::getDef('placeholder_search') . '"') . HTML::button(array('type' => 'button', 'params' => 'onclick="osC_DataTable.reset();"', 'title' => OSCOM::getDef('button_reset'))); ?>

  <span style="float: right;"><?php echo HTML::button(array('href' => OSCOM::getLink(null, null, 'Save'), 'icon' => 'plus', 'title' => OSCOM::getDef('button_insert'))); ?></span>
</form>

<div style="padding: 20px 5px 5px 5px; height: 16px;">
  <span id="batchTotalPages"></span>
  <span id="batchPageLinks"></span>
</div>

<form name="batch" action="#" method="post">

<table border="0" width="100%" cellspacing="0" cellpadding="2" class="dataTable" id="siteDataTable">
  <thead>
    <tr>
      <th><?php echo OSCOM::getDef('table_heading_sites'); ?></th>
      <th width="150"><?php echo OSCOM::getDef('table_heading_action'); ?></th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th colspan="2">&nbsp;</th>
    </tr>
  </tfoot>
  <tbody>
  </tbody>
</table>

</form>

<div style="padding: 2px;">
  <span id="dataTableLegend"><?php echo '<b>' . OSCOM::getDef('table_action_legend') . '</b> ' . HTML::icon('edit.png') . '&nbsp;' . OSCOM::getDef('icon_edit') . '&nbsp;&nbsp;' . HTML::icon('play.png') . '&nbsp;' . OSCOM::getDef('icon_play'); ?></span>
  <span id="batchPullDownMenu"></span>
</div>

<script type="text/javascript">
  var moduleParamsCookieName = 'oscom_admin_' + pageModule;
  var dataTablePageSetName = 'page';

  var moduleParams = new Object();
  moduleParams[dataTablePageSetName] = 1;
  moduleParams['search'] = '';

  if ( $.cookie(moduleParamsCookieName) != null ) {
    moduleParams = $.secureEvalJSON($.cookie(moduleParamsCookieName));
  }

  var dataTableName = 'siteDataTable';
  var dataTableDataURL = '<?php echo OSCOM::getRPCLink(null, null, 'GetAll'); ?>';

  var siteLink = '<?php echo OSCOM::getLink(null, null, 'id=SITEID'); ?>';
  var siteLinkIcon = '<?php echo HTML::icon('folder.png'); ?>';

  var siteEditLink = '<?php echo OSCOM::getLink(null, null, 'Save&id=SITEID'); ?>';
  var siteEditLinkIcon = '<?php echo HTML::icon('edit.png'); ?>';

  var siteOpenLink = '<?php echo OSCOM::getConfig('http_server', OSCOM::getDefaultSite()) . OSCOM::getConfig('dir_ws_http_server', OSCOM::getDefaultSite()) . OSCOM::getConfig('bootstrap_file', 'OSCOM') . '?SITEID'; ?>';
  var siteOpenLinkIcon = '<?php echo HTML::icon('play.png'); ?>';

  var osC_DataTable = new osC_DataTable();
  osC_DataTable.load();

  function feedDataTable(data) {
    var rowCounter = 0;

    for ( var r in data.entries ) {
      var record = data.entries[r];

      var newRow = $('#' + dataTableName)[0].tBodies[0].insertRow(rowCounter);
      newRow.id = 'row' + record.id;

      $('#row' + record.id).hover( function() { $(this).addClass('mouseOver'); }, function() { $(this).removeClass('mouseOver'); }).click(function(event) {
        if (event.target.type !== 'checkbox') {
          $(':checkbox', this).trigger('click');
        }
      }).css('cursor', 'pointer');

      var newCell = newRow.insertCell(0);
      newCell.innerHTML = siteLinkIcon + '&nbsp;<a href="' + siteLink.replace('SITEID', record.id) + '" class="parent">' + htmlSpecialChars(record.id) + '</a>';

      newCell = newRow.insertCell(1);
      newCell.innerHTML = '<a href="' + siteEditLink.replace('SITEID', record.id) + '">' + siteEditLinkIcon + '</a>&nbsp;<a href="' + siteOpenLink.replace('SITEID', record.id) + '" target="_blank">' + siteOpenLinkIcon + '</a>';
      newCell.align = 'right';

      rowCounter++;
    }
  }
</script>
