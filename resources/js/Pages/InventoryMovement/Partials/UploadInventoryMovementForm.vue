<template>
  <form @submit.prevent="submit">
    <div class="flex flex-col justify-center">
      <div class="flex">
        <div class="mb-3 w-96">
          <label
            for="formFile"
            class="form-label inline-block mb-2 text-gray-700"
            >Upload Inventory Movement File</label
          >
          <div class="flex">
            <input
              class="
                form-control
                block
                w-full
                px-3
                py-1.5
                text-base
                font-normal
                text-gray-700
                bg-white bg-clip-padding
                border border-solid border-gray-300
                rounded
                transition
                ease-in-out
                m-0
                focus:text-gray-700
                focus:bg-white
                focus:border-blue-600
                focus:outline-none
              "
              type="file"
              @input="form.inventory_movements_file = $event.target.files[0]"
            />
            <!-- TODO: add progress bar -->
            <button
              type="submit"
              class="
                ml-2
                bg-blue-500
                hover:bg-blue-700
                text-white
                font-bold
                py-2
                px-4
                rounded
              "
            >
              Upload
            </button>
          </div>
        </div>
      </div>
    </div>
    <ul>
      <li v-for="(error, key) in form.errors" :key="key">{{ error }}</li>
    </ul>
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
