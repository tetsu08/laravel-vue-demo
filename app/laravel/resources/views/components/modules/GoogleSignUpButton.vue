<template>
  <button class="google-sign-up-button" @click="googleSignUp" />
</template>

<script lang='ts'>
import { defineComponent } from 'vue';
import { getAuth, signInWithPopup, GoogleAuthProvider } from '@firebase/auth';

export default defineComponent({
  setup(props, context) {
    const googleSignUp = (event: any) => {
      signInWithPopup(getAuth(), new GoogleAuthProvider())
        .then((result) => {
          context.emit('signUp', result.user);
        })
        .catch((error) => {
          if (
            error.code == 'auth/cancelled-popup-request' ||
            error.code == 'auth/popup-closed-by-user'
          ) {
            return;
          }
          context.emit('errorHandler');
        });
      event.target.blur();
    };
    return { googleSignUp };
  },
});
</script>

<style lang='scss' scoped>
.google-sign-up-button {
  width: 25em;
  height: 6em;
  border: 0;
  background-repeat: no-repeat;
  background-image: url('../images/btn_google_signin_dark_normal.png');
  &:hover {
    background-image: url('../images/btn_google_signin_dark_focus.png');
  }
  &:active,
  &:focus {
    background-image: url('../images/btn_google_signin_dark_pressed.png');
  }
  background-size: cover;
  cursor: pointer;
}
</style>