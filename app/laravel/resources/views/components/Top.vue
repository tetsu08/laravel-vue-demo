<template>
  <v-app>
    <ProgressSpinner v-if="inProgress" />
    <GoogleSignUpButton
      v-else
      @signUp="signUp"
      @errorHandler="errorHandler"
    />
  </v-app>
</template>

<script lang='ts'>
import { defineComponent, ref } from 'vue';
import { User } from '@firebase/auth';
import { useRouter } from 'vue-router';
import { useStore } from 'vuex';
import GoogleSignUpButton from './modules/GoogleSignUpButton.vue';
import ProgressSpinner from 'primevue/progressspinner';
import api from '../../scripts/plugins/Axios';

export default defineComponent({
  name: 'Top',
  components: {
    GoogleSignUpButton,
    ProgressSpinner
  },
  setup(props, context) {
    const inProgress = ref(false);
    const errorHandler = () => {
      context.emit('errorHandler');
    }
    const router = useRouter();
    const store = useStore();
    const signUp = async (user: User) => {
      inProgress.value = true;
      let idToken = await user.getIdToken();
      api('user/sign-up', 'v1', context)
        .setIntercepter(router)
        .post(
          {
            name: user.displayName,
            email: user.email,
            imageUrl: user.photoURL
          },
          idToken
        )
        .then(() => {
          store.commit('saveToken', idToken);
          store.commit('saveEmail', user.email);
          inProgress.value = false;
          router.push('/welcome');
        })
        .catch(() => {
          inProgress.value = false;
        });
    };

    return { inProgress, signUp, errorHandler };
  }
});
</script>