const { defineConfig } = require("cypress");

module.exports = defineConfig({
  chromeWebSecurity: false,
  retries: 2,
  defaultCommandTimeout: 5000,
  watchForFileChanges: false,
  videosFolder: "tests/Integration/videos",
  screenshotsFolder: "tests/Integration/screenshots",
  fixturesFolder: "tests/Integration/fixture",

  e2e: {
    setupNodeEvents(on, config) {
      return require("./tests/Integration/plugins/index.js")(on, config);
    },
    baseUrl: "http://localhost:8000",
    specPattern: "tests/Integration/integration/**/*.cy.{js,jsx,ts,tsx}",
    supportFile: "tests/Integration/support/index.js",
  },

  component: {
    devServer: {
      framework: "vue",
      bundler: "vite",
    },
  },
});
