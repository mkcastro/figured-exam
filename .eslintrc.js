module.exports = {
  env: {
    es2021: true,
    node: true,
  },
  extends: [
    'plugin:vue/essential',
  ],
  parserOptions: {
    ecmaVersion: 'latest',
    sourceType: 'module',
  },
  plugins: [
    'vue',
  ],
  rules: {
    "vue/multi-word-component-names": "off",
    "vue/no-multiple-template-root": "off",
    "vue/no-v-for-template-key": "off",
    "vue/no-v-model-argument": "off",
    "vue/no-arrow-functions-in-watch": "off",
  },
};
