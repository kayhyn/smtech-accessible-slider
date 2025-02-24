<?php
/*
 * Plugin admin page
 * Add, remove, and customise sliders here 
*/
$sliders = get_option('smtech_slider_arr');

if( isset($_GET["newSlider"]) ) {
  $sliders[] = array(
    "name" => "New Slider",
    "dynamic" => true,
    "stylesheet" => "default.css",
  );
  update_option('smtech_slider_arr', $sliders);
  
} else if(isset($_GET["delSlider"])) {
  // this code is not idempotent - there should ideally be a UUID or something
  unset($sliders[$_GET["delSlider"]]);
  update_option('smtech_slider_arr', $sliders);
} else if(isset($_GET["updateSlider"])) {
  $sliders[$_POST["sliderId"]] = array(
    "name" => $_POST["sliderName"],
    "dynamic" => $_POST["sliderContent"],
    "stylesheet" => $_POST["sliderStyle"],
  );
  update_option('smtech_slider_arr', $sliders);
}



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
  

  
  try {
    document.getElementById(TabName).style.display = "block";
    evt.currentTarget.className += " active";
  } catch {
    /* TODO: return to updated slider */
    Array.from(document.getElementsByClassName("tabcontent")).at(-1).style.display = "block";
    document.getElementById("tabselector").lastElementChild.className += " active";
  }
}
window.onload = function(){
  openTab(null,null)
  }
function confirmDialog(s) {
  document.getElementById("delete-target").innerHTML = s;
  document.getElementById("delete-modal-confirm").href="?page=test-plugin&delSlider="+s;
  document.getElementById("delete-modal-cancel").addEventListener("click",()=>{
    document.getElementById("delete-modal").close();
  });
  document.getElementById("delete-modal").showModal();
}
</script>

<dialog class="warning-modal" id="delete-modal">
  <p>Are you sure you want to permanently delete this slider?</p>
  <p class="danger">There is no going back.</p>
  <a id="delete-modal-confirm"><button class="btn btn-danger">Yes, delete <span id="delete-target"></span>.</button></a> <button class="btn" id="delete-modal-cancel" autofocus>Cancel</button>
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
  foreach($sliders as $i => $s) { ?>
    <button class="tablinks" onclick="openTab(event, 'slider_<?=$i?>')"><?=$s["name"]?></button>
<?php 
  } ?>
</div>

<?php
/* loop through sliders and put their settings onto the page */
    foreach($sliders as $i => $s) { ?>
    <div id="slider_<?=$i?>" class="tabcontent">
  <h3>Settings</h3>
  <form action="?page=test-plugin&updateSlider=true" method="post">
    <input type="hidden" name="sliderId" value="<?=$i?>">
    <label for="slider<?=$i?>-name">Name: </label><br>
    <input type=text" id="slider<?=$i?>-name" name="sliderName" value="<?=$s["name"]?>"><br><br>
    <label for="slider<?=$i?>-stylesheet">Stylesheet: </label><br>
    <input type=text" id="slider<?=$i?>-stylesheet" name="sliderStyle" value="<?=$s["stylesheet"]?>"><br><br>
    Slider loads content:<br>
    <input type="radio" id="slider<?=$i?>-dynamic" name="sliderContent" value=1 <?=$s["dynamic"]?"checked":""?> ><label for="slider<?=$i?>-dynamic">Dynamically</label><br>
    <input type="radio" id="slider<?=$i?>-static" name="sliderContent" value=0 <?=!$s["dynamic"]?"checked":""?> ><label for="slider<?=$i?>-dynamic">Statically</label><br>
    <br>


    <input type="submit" class="btn btn-submit"></button>
  </form>
  <h3>Danger zone</h3>
  <p>
    <a class="danger" href="#" onclick="confirmDialog('<?=$i?>')">Delete this slider</a>
  </p>
</div>

<?php }
} ?>
<a href="?page=test-plugin&newSlider=true"?><button>Add new slider</button></a>



</div>