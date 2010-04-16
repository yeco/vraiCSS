vraiCSS
=========

VraiCSS its a simple yet useful script that allows to use vars (and soon other methods) on CSS allowing some code reuse.


Feature(s)
---
   - variable support
 
   ###Wishlist (future features)###
   - Math Operations
   - include() support
   - Minimize / pack


Usage
---
Add this rewrite rule to .htaccess on your project folder:

        *RewriteRule ^(.*)\.css$ /vraiCSS.php?css=$1.css [L]*
    

Now you can add your vars as comments using this syntax:
    

    /*
    !DARKBLUE    #04517C
    !LIGHTBLUE    #0480C7
    !INNERBORDER        1px solid #369
    */

    h1 { color: !DARKBLUE; font-size: 1.1em }
    p { color: !LIGHTBLUE; font-style: italic }
    div { color: !LIGHTBLUE; border: !INNERBORDER }