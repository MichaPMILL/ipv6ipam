# Ip6 class
To do : create the app :) 
Only for educationnal purposes. Don't use in production environnement without modifications. 
That class gives possibilty to handle IPv6 addresses block using PHP.  
That class allows for example to condense or to give a prefix in its expanded form and to cut blocks.

## Builder
```PHP
//1st parameter prefix, 2nd parameter size of the prefix
$block = new Ip6 ("2001:db8::",32);
````
## CIDR Prefix
```PHP
$cidr= $block->displayPrefixeCIDR();
// returns $cidr => 2001:db8::/32
````
## Expending prefix
```PHP
$expanded = $block->prefixeDecondense();
// returns $expanded => 2001:0db8:0000:0000:0000:0000:0000:0000
````
## Condensing prefix
```PHP
$condensed = $block->prefixeCondense();
// returns $expanded => 2001:db8::
````
## Binary prefix
```PHP
$bin = $block->prefixeBin();
````
Returns the prefix under it binary form (composed of ones and zeros)
## Prefix expending without separators
```PHP
$wseparators = $block->prefixeExt();
````
## "Subnet cutting" 
```PHP
//Parameter : int subnet size
$subnet = $block->sousReseaux(x);
````
It returns an array of iP6 objects with the desired size. 

## Getters
```PHP
//Returns prefix
$prefixe = $block->getPrefixe();

//Returns block size
$prefixe = $block->getLongueur();



