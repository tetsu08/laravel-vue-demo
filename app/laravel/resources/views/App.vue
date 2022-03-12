<template>
  <div>
    <router-view @successHandler="successHandler" @errorHandler="errorHandler" />
    <Toast />
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { useToast } from "primevue/usetoast";
import Toast from "./components/modules/Toast.vue";

export default defineComponent({
  name: "App",
  components: {
    Toast,
  },
  setup() {
    const toast = useToast();
    const successHandler = () => {
      toast.removeAllGroups();
      toast.add({ severity: 'success', summary: 'サインアップが完了しました' });
    };
    const errorHandler = (result) => {
      toast.removeAllGroups();
      if (result.errors) {
        let items = [];
        Object.values(result.errors).forEach((error: []) => {
          error.forEach((message) => {
            items.push(message);
          })
        });
        toast.add({ severity: 'error', summary: '連携項目にエラーがあります', detail: items });
      } else {
        console.dir(result);
        toast.add({ severity: 'error', summary: 'システムエラーが発生しました' });
      }
    };

    return { successHandler, errorHandler };
  },
});
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
