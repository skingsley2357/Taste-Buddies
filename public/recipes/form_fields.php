<?php

// prevents this code from being loaded directly in the browser
// or without first setting the necessary object
if(!isset($recipe)) {
  redirect_to(url_for('index.php'));
}
?>

<dl>
  <dt>Name</dt>
  <dd><input type="text" name="recipe[common_name]" value="<?php echo h($recipe->common_name); ?>" /></dd>
</dl>

<dl>
  <dt>Habitat</dt>
  <dd><input type="text" name="recipe[habitat]" value="<?php echo h($recipe->habitat); ?>" /></dd>
</dl>


<dl>
  <dt>Food</dt>
  <dd><input type="text" name="recipe[food]" value="<?php echo h($recipe->food); ?>" /></dd>
</dl>

<dl>
  <dt>Conservation</dt>
  <dd>
    <select name="recipe[conservation_id]">
      <option value=""></option>
    <?php foreach(recipe::CONSERVATION_OPTIONS as $cons_id => $cons_name) { ?>
      <option value="<?php echo $cons_id; ?>" <?php if($recipe->conservation_id == $cons_id) { echo 'selected'; } ?>><?php echo $cons_name; ?></option>
    <?php } ?>
    </select>
  </dd>
</dl>
  
  <dl>
    <dt>Backyard Tips</dt>
    <dd><textarea name="recipe[backyard_tips]" rows="5" cols="50"><?php echo h($recipe->backyard_tips); ?></textarea></dd>
  </dl>

