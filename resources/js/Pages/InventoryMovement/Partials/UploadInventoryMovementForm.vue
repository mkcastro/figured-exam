<template>
  <form @submit.prevent="submit">
    <div class="flex flex-col">
      <input
        type="file"
        @input="form.inventory_movements_file = $event.target.files[0]"
      />
      <div class="flex">
        <progress
          v-if="form.progress"
          :value="form.progress.percentage"
          max="100"
        >
          {{ form.progress.percentage }}%
        </progress>
        <button type="submit">Submit</button>
      </div>
    </div>
  </form>
</template>

<script>
export default {
  data() {
    return {
      form: this.$inertia.form({
        inventory_movements_file: null,
      }),
    };
  },
  methods: {
    submit() {
      this.form.post(route("inventory-movements.store"));
    },
  },
};
</script>
