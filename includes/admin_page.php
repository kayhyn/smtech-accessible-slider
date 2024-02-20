<style>
/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons that are used to open the tab content */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}

</style>

<script>
    function openCity(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  if(cityName=="London") {
    tablinks[0].className += " active";
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
window.onload = function(){openTab(null,'slider1')}
</script>

<div>
    <h1>Student Media In-House Slider Settings</h1>
    <!-- Tab links -->
     <h2>Global settings</h2>
        <form>
            <label>Test</label><input type="text" />
        </form>
     <h2>Sliders</h2>
<div class="tab">
  <button class="tablinks active" onclick="openCity(event, 'slider1')">Slider 1</button>
  <button class="tablinks" onclick="openCity(event, 'slider2')">Slider 2</button>
  <button class="tablinks" onclick="openCity(event, 'slider3')">Slider 3</button>
</div>

<?php
    for($i=0;$i<3;$i++) { ?>
    <!-- Tab content -->
    <div id="<?=$slider[$i]?>" class="tabcontent">
  <h3>Settings</h3>
  <p>ABC.</p>
</div>
<?php } ?>

</div>