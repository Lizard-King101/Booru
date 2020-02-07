<?php session_start()?>
<div id="settings-container">
  <form class="form">
   
    <div class="form-row">
      <div class="label head">Settings</div>
      <div class="form-item">
        <a class="form-button danger" onClick="SettingsClose()"><i class="fa fa-times icon"></i></a>
      </div>
    </div>
    
    <div class="form-row">
      <div class="label">Auto Play</div>
      <div class="form-item">
        <label class="switch">
          <?php if(isset($_SESSION['autoplay'])){
            if($_SESSION['autoplay'] == 'true'){?>
              <input id="autoplay" class="setting" onchange="UpdateSettings()" type="checkbox" checked>
            <?php }else{ ?>
              <input id="autoplay" class="setting" onchange="UpdateSettings()" type="checkbox">
            <?php }
          }else{ ?>
            <input id="autoplay" class="setting" onchange="UpdateSettings()" type="checkbox">
          <?php }?>
          <span class="slider round"></span>
        </label>
      </div>
    </div>
    
    <div class="form-row">
      <div class="label">Repeat</div>
      <div class="form-item">
        <label class="switch">
          <?php if(isset($_SESSION['repeat'])){
            if($_SESSION['repeat'] == 'true'){?>
              <input vid-var id="repeat" class="setting" onchange="UpdateSettings()" type="checkbox" checked>
            <?php }else{ ?>
              <input vid-var id="repeat" class="setting" onchange="UpdateSettings()" type="checkbox">
            <?php }
          }else{ ?>
            <input vid-var id="repreat" class="setting" onchange="UpdateSettings()" type="checkbox">
          <?php }?>
          <span class="slider round"></span>
        </label>
      </div>
    </div>
    
  </form>
</div>