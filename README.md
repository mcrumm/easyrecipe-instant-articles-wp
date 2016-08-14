# Recipe Instant Articles

Enhances formatting of [EasyRecipe Plus](http://easyrecipeplugin.com/) content when publishing [Facebook Instant Articles](https://wordpress.org/plugins/fb-instant-articles/) from your WordPress site.

## Requirements

- [EasyRecipe Plus](http://easyrecipeplugin.com/)*
- [Instant Articles for WP](https://wordpress.org/plugins/fb-instant-articles/)

>\* This helper plugin only works with EasyRecipe Plus. The free version, EasyRecipe, is not supported.

## Setup

Install and activate the **Recipe Instant Articles** plugin, then add the custom transformer rules in the Instant Articles for WP settings.

### Custom Transformer Rules

You can use the list of custom transformations below to begin formatting your EasyRecipe Plus content.

Copy and paste the following rules into the **Custom Transformer Rules** settings in the Instant Articles for WP plugin.

```json
{ "rules": [
  { "class": "IgnoreRule", "selector": "div.ERSClear" },
  { "class": "IgnoreRule", "selector": "div.ERSSavePrint" },
  { "class": "IgnoreRule", "selector": "div.endeasyrecipe" },
  { "class": "PassThroughRule", "selector": "div.easyrecipe" },
  { "class": "PassThroughRule", "selector": "div.ERSDetails" },
  { "class": "PassThroughRule", "selector": "div.ERSTimes" },
  { "class": "PassThroughRule", "selector": "link" },
  { "class": "PassThroughRule", "selector": "div.ERSIngredients" },
  { "class": "PassThroughRule", "selector": "div.ERSInstructions" },
  { "class": "PassThroughRule", "selector": ".instructions" },
  { "class": "PassThroughRule", "selector": "div.ERSNutrition" },
  { "class": "H2Rule", "selector": "div.ERSIngredientsHeader" },
  { "class": "H2Rule", "selector": "div.ERSInstructionsHeader" },
  { "class": "H2Rule", "selector": "div.ERSName" },
  { "class": "H2Rule", "selector": "div.ERSNotesHeader" },
  { "class": "ParagraphRule", "selector": "div.ERSAuthor" },
  { "class": "ParagraphRule", "selector": "div.ERSHead" },
  { "class": "ParagraphRule", "selector": "div.ERSNotes" },
  { "class": "ParagraphRule", "selector": "div.ERSSectionHead" },
  { "class": "ItalicRule", "selector": "time" }
] }
```
