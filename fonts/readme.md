# IcoMoon Font
You can edit this font by importing `icomoon.svg` to the IcoMoon App: https://icomoon.io/app

## Using the IcoMoon App
1. Add/Remove characters from the font
2. Generate font
3. Download font
4. Copy the new font files back into this folder
5. Reference the characters in the theme!

## Example
From `https://github.com/dbaker3/welshimer2015_prc/blob/master/sass/_typography.scss#L6-L14`:
```
@font-face {
    font-family: "icon-font";
    font-style: normal;
    font-weight: normal;
    src: url("fonts/icomoon.eot?#iefix") format("embedded-opentype"), 
         url("fonts/icomoon.woff") format("woff"), 
         url("fonts/icomoon.ttf") format("truetype"), 
         url("fonts/icomoon.svg#icon-font") format("svg");
  }
```
From `https://github.com/dbaker3/welshimer2015_prc/blob/master/sass/_widgets.scss#L13-L19`:
```
.clock-icon {
   &:before {
   margin-right:0.5em;
   font-family:icon-font;
   content:"\e600";
   }
}
```
