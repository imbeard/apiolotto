module.exports = {
  content: [
  'theme/views/**/*.twig'
  ],
  theme: {
    extend: {
      colors: {
        'custom-greydark': '#2d2d2c',
        'custom-yellow': '#e5db17',
        'custom-pink': '#cc66a1',
        'custom-green': '#009474',
        'custom-brown': '#665229',
        'custom-black': '#2D2D2C',
        'custom-blacklight': '#4a4a49',
        'custom-grey': '#A0A0A0',
        'custom-greylight' : '#81817F', 
        'custom-superlight' : '#f0efef',
      },
      spacing: {
        '3/2': '150%',
        '4/3': '133.333333%',
        '5/4': '125%',
        '1/1': '100%',
        '1/2': '50%',
        '1/3': '33.333333%',
        '2/3': '66.666667%',
        '1/4': '25%',
        '2/4': '50%',
        '3/4': '75%',
        '1/5': '20%',
        '2/5': '40%',
        '3/5': '60%',
        '4/5': '80%',
        '1/6': '16.666667%',
        '2/6': '33.333333%',
        '3/6': '50%',
        '4/6': '66.666667%',
        '5/6': '83.333333%',
        '1/12': '8.333333%',
        '2/12': '16.666667%',
        '3/12': '25%',
        '4/12': '33.333333%',
        '5/12': '41.666667%',
        '6/12': '50%',
        '7/12': '58.333333%',
        '8/12': '66.666667%',
        '9/12': '75%',
        '10/12': '83.333333%',
        '11/12': '91.666667%',
      },
      gridTemplateColumns: {
        '14': 'repeat(14, minmax(0, 1fr))',
        '16': 'repeat(16, minmax(0, 1fr))',
      },
      typography: (theme) => ({
        DEFAULT: {
          css: {
            /*color: theme('colors.custom-black'),
            h1: {
              color: theme('colors.custom-black'),
            },
            'ul > li::before': {
              backgroundColor: theme('colors.custom-black'),
            },*/
          },
        },
      }),
    },
  },
  plugins: [
    require('@tailwindcss/forms'), require('@tailwindcss/typography')
  ],
};
