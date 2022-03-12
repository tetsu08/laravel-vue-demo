<template>
  <v-app>
    <ProgressSpinner v-if="inProgress" />
    <Image v-else :src="welcomeImagePath" @error="displayNoImage" width="300" alt="Welcome Image" preview />
  </v-app>
</template>

<script lang='ts'>
import { defineComponent, ref } from 'vue';
import { useRouter } from 'vue-router';
import { useStore } from 'vuex';
import Image from 'primevue/image';
import ProgressSpinner from 'primevue/progressspinner';
import api from '../../scripts/plugins/Axios';

export default defineComponent({
  name: 'Welcome',
  components: {
    Image,
    ProgressSpinner
  },
  setup(props, context) {
    const inProgress = ref(false);
    const welcomeImagePath = ref('');

    const router = useRouter();
    const store = useStore();
    const displayWelcomImage = () => {
      inProgress.value = true;
      let token = store.getters.getToken;
      let email = store.getters.getEmail;
      api('user/welcome', 'v1', context)
        .setIntercepter(router)
        .get(`?email=${email}`, token)
        .then((result) => {
          welcomeImagePath.value = result.welcomeImage.path;
          inProgress.value = false;
          context.emit('successHandler');
        })
        .catch(() => {
          inProgress.value = false;
        });
    };
    const displayNoImage = () => {
      welcomeImagePath.value = location.origin + '/build/images/no_image.png';
    };

    displayWelcomImage();

    return { inProgress, welcomeImagePath, displayNoImage };
  },
});
</script>
