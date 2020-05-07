






















/* Check all font sizes are big enough for mobile devices */
let all = document.getElementsByTagName("*");

for (let i=0, max=all.length; i < max; i++) {

    let fontSize = parseFloat(window.getComputedStyle(all[i], null).getPropertyValue('font-size'));

    if ( fontSize < 12 ) { // Smallest font allowed is 12px for accessibility
        all[i].style.fontSize = '12px';
    }
}
