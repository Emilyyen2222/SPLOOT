<template>
    <nav class="nav">
      <ul class="nav_list">
        <li><a href="./">待辦事項</a></li>
        <li><a href="./about_us.html">關於我們</a></li>
      </ul>
    </nav>
  </template>
  
  <script>
  </script>
  
  <style lang="sass" scoped>
    nav.nav
      // border: 1px solid red
      margin-top: 30px
      ul.nav_list
        // border: 1px solid orange
        list-style: none
        margin: 0
        padding: 0
        display: flex
        > li
          // border: 1px solid blue
          margin-right: 20px
          > a
            font-size: 1.6rem
            color: gray
            display: inline-block
            text-decoration: none
            padding: 3px 0px 2px
            &:hover, &.-on
              color: blue
  </style>