<template>
  <v-app>
    <div id="message">
      <p>{{ statusCode }}</p>
      <p>
        <transition name="fade">
          <span v-if="isComplete">Not Found</span>
        </transition>
      </p>
    </div>
  </v-app>
</template>

<script lang='ts'>
import { defineComponent, ref } from "vue";
import anime from "animejs/lib/anime.es.js";

export default defineComponent({
  setup() {
    const statusCode = ref(0);
    const isComplete = ref(false);

    let loopCount = 0;
    const countUpTo404 = () => {
      anime({
        targets: statusCode,
        value: 404,
        easing: "easeInOutSine",
        round: 1,
        duration: 4000,
        update: () => {
          document.getElementById("message").style.fontSize =
            String(10 + (loopCount / 2)) + "px";
          loopCount++;
        },
        complete: () => {
          isComplete.value = true;
        },
      });
    };
    countUpTo404();
    return { statusCode, isComplete };
  },
});
</script>

<style scoped>
#message {
  font-size: 10px;
}
.fade-enter-active,
.fade-leave-active {
  transition: opacity 5s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>