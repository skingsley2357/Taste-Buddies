`use strict`

function addIngredient() {
  // Find the container where the ingredients are listed
  var ingredientsList = document.getElementById('ingredientsList');

  // Clone the entire ingredients list
  var clonedIngredients = ingredientsList.cloneNode(true);

  // Clear the values in the cloned inputs/selects
  var selects = clonedIngredients.getElementsByTagName('select');
  for (var i = 0; i < selects.length; i++) {
    selects[i].selectedIndex = 0; // Resets to the first option
  }
  var inputs = clonedIngredients.getElementsByTagName('input');
  for (var i = 0; i < inputs.length; i++) {
    if (inputs[i].type === 'text' || inputs[i].type === 'number') {
      inputs[i].value = ''; // Clear text and number inputs
    } else if (inputs[i].type === 'checkbox' || inputs[i].type === 'radio') {
      inputs[i].checked = false; // Uncheck checkboxes and radios
    }
  }

  // Append the cloned ingredients list to the original ingredients list
  ingredientsList.parentNode.appendChild(clonedIngredients);
}


