<?php
session_start();
if (!isset($_SESSION["resemail"])) {
    if (isset($_SESSION["cusemail"])) {
        header("location: ../index.php?error=notallowedadding");
        exit();
    }
    header("location: ../register.php");
    exit();
}
require_once './header.comp.php';
?>


<div class="form-title">
    <h2>Add Menu</h2>
</div>

<form class="form_menu" action="../Includes/addMenu.inc.php" method="post">

    <div class="field-wrap menu-wrap">
        <label for="food">Food Item</label>
        <input class="menu" type="text" name="foodItem" required autocomplete="off" placeholder="" />
    </div>

    <div class="field-wrap menu-wrap">
        <label for="food">Serves No. of People</label>
        <input class="menu" type="number" name="people" required autocomplete="off" placeholder="" />
    </div>

    <div class="field-wrap menu-wrap">
        <label for="food">Cost</label>
        <input class="menu" type="number" name="cost" required autocomplete="off" placeholder="" />
    </div>
    <div class="field-wrap preference-head menu-wrap">
        <label class="menu-label">Food Preference</label>
        <div class="preference" id="radio-switch">
            <input class="" id="" name="food-type" type="radio" value="Veg" checked="checked">
            <label for="Veg" onclick="">Veg</label>
            <input class="" id="" name="food-type" type="radio" value="NonVeg">
            <label for="Non-Veg" onclick="">Non-Veg</label>
        </div>
    </div>

    <button type="submit" class="menu-button menu-button-block" name="submit" />ADD</button>


</form>
<?php
if (isset($_GET["error"])) {
    if ($_GET["error"] == "stmtfailed") {
        echo "<script type=\"text/javascript\">alert(\"Illegal inputs!\");";
        echo "</script>";
    }
}
?>
<?php
require_once '../footer.php';

?>