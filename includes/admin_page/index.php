<?php
/*
 * Plugin admin page
 * Add, remove, and customise sliders here 
*/

$sliders = array("slider1","slider2","slider3");

?>

<style>
<?php include("stylesheet.css") ?>
</style>
<script>
    function openTab(evt, TabName) {
  var i, tabcontent, tablinks;

  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  

  document.getElementById(TabName).style.display = "block";
  try {
    evt.currentTarget.className += " active";
  } catch {
    document.getElementById("tabselector").firstElementChild.className += " active";
  }
}
window.onload = function(){
  openTab(null,'slider1')
  }
function confirmDialog(s) {
  document.getElementById("delete-target").innerHTML = s;
  document.getElementById("delete-modal-cancel").addEventListener("click",()=>{
    document.getElementById("delete-modal").close();
  });
  document.getElementById("delete-modal").showModal();
}
</script>

<dialog class="warning-modal" id="delete-modal">
  <p>Are you sure you want to permanently delete this slider?</p>
  <p class="danger">There is no going back.</p>
  <button class="btn btn-danger">Yes, delete <span id="delete-target"></span>.</button> <button class="btn" id="delete-modal-cancel" autofocus>Cancel</button>
</dialog>

<div>
    <h1>Student Media In-House Slider Settings</h1>
     <h2>Global settings</h2>
        <form>
            <pre>Settings go here</pre>
        </form>
     <h2>Sliders</h2>
<?php
if(!$sliders) {
?>
  <div class="error no-sliders">
    <h3>There are currently no sliders configured! Click below to add the first!</h3>
  </div>
<?php
} else {
?>
<div class="tab" id="tabselector">
<?php
  foreach($sliders as $s) { ?>
    <button class="tablinks" onclick="openTab(event, '<?=$s?>')"><?=$s?></button>
<?php 
  } ?>
</div>

<?php
/* loop through sliders and put their settings onto the page */
    foreach($sliders as $s) { ?>
    <!-- Tab content -->
    <div id="<?=$s?>" class="tabcontent">
  <h3>Settings</h3>
  <p>ABC.</p>
  <h3>Danger zone</h3>
  <p>
    <a class="danger" href="#" onclick="confirmDialog('<?=$s?>')">Delete this slider</a>
  </p>
</div>

<?php }
} ?>
<button>Add new slider</button>



</div>