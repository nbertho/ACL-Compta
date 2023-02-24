<template>
  <header>
    <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
      <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
        <router-link :to="{name: 'home'}" class="flex flex-row">
          <img src="https://flowbite.com/docs/images/logo.svg" class="mr-8 h-6 sm:h-9" alt="Los Babos Logo" />
          <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Los Babos</span>
        </router-link>
        <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
          <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
            <li v-for="link in links" :key="link.path">
              <router-link 
                class="block py-2 text-gray-300 hover:text-white hover:underline"
                :to="{name: link.pathName}"
              >{{ link.name }}</router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
</template>

<script>
export default ({
  name: 'TheHeader',
  data() {
    return {
      links: [
        { name: 'Accueil', pathName: 'home' },
        { name: 'Patients', pathName: 'patients' },
        { name: 'Séances', pathName: 'sessions' },
        { name: 'Aide', pathName: 'help' },
      ]
    }
  },
  methods: {
    redirectToHome() {
      this.$router.push('/');
    }
  }
})
</script>
