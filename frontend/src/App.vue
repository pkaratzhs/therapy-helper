<template>
<!-- App.vue -->
<v-app>
  <v-navigation-drawer app>
      drawer
  </v-navigation-drawer>

  <v-app-bar app>
    Therapy App
  </v-app-bar>

  <!-- Sizes your content based upon application components -->
  <v-main>

    <!-- Provides the application the proper gutter -->
    <v-container fluid>

      <!-- If using vue-router -->
      <router-view></router-view>
    </v-container>
  </v-main>

  <v-footer app>
    <!-- -->
  </v-footer>
</v-app>
</template>

<script>


export default {
  name: 'App',


  data: () => ({
    //
  }),
};
</script>
