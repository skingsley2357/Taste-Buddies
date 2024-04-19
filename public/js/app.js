`use strict`

function addIngredient() {
  // Find the container where the ingredients are listed
  var ingredientsList = document.getElementById('ingredientsList');

  // Find the last ingredient input section (div) and clone it
  var lastIngredientDiv = ingredientsList.lastElementChild.cloneNode(true);

  // Clear the values in the cloned inputs/selects if needed
  var selects = lastIngredientDiv.getElementsByTagName('select');
  for (var i = 0; i < selects.length; i++) {
      selects[i].selectedIndex = "";
  }
  var inputs = lastIngredientDiv.getElementsByTagName('input');
  for (var i = 0; i < inputs.length; i++) {
      inputs[i].value = '';
  }

  // Append the cloned div to the ingredients list
  ingredientsList.appendChild(lastIngredientDiv);
}
