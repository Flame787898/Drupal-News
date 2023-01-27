(function ($, Drupal, drupalSettings) {
  Drupal.behaviors.ExchangeRatesBehavior = {
    attach: function (context, settings) {
      if (context !== document) {
        return;
      }
      const data = settings.exchange_rates.exchange_data;
      const currency = settings.exchange_rates.currency_name;
      const date = [];
      const saleRate = []
      const currencyName = Object.keys(currency)
      let allData = [];

      let emptyArr = [];
      let dataObj = []
      const getFiteredArray = () => {
        for (let i = 0; i < currencyName.length; i++) {
          const filteredArray = data.map(x => x.filter(function (data) {
            return data.currency == currencyName[i];
          }))
          allData.push(filteredArray);
        }
        return allData;
      }
      const getObjectArrayRates = () => {
        for (let i = 0; i < allData.length; i++) {
          for (let j = 0; j < allData[i].length; j++) {
            emptyArr.push(allData[i][j][0].saleRateNB)
            obj = {
              rate: [...emptyArr]
            }
            dataObj[i] = obj
          }
          emptyArr = []
        }
        return dataObj;
      }

      getFiteredArray();
      getObjectArrayRates();

      const ctx = document.getElementById('myChart');
      data.map((x) => (x.map((x) => (date.push(x.date)))));

      const object = [];
      for (let i = 0; i < currencyName.length; i++) {
        const randomBetween = (min, max) => min + Math.floor(Math.random() * (max - min + 1));
        const r = randomBetween(0, 255);
        const g = randomBetween(0, 255);
        const b = randomBetween(0, 255);

        const dataFirst = {
          label: currencyName[i],
          data: dataObj[i].rate,
          lineTension: 0,
          fill: false,
          borderColor: `rgb(${r},${g},${b})`
        };
        object[i] = dataFirst;
      }

      const totalDays = []
      for (let i = 0; i<date.length; i+=currencyName.length){
         totalDays.push(date[i]);
      }

      const speedData = {
        labels: totalDays,
        datasets: object
      };

      const chartOptions = {
        legend: {
          display: true,
          position: 'top',
          labels: {
            boxWidth: 80,
            fontColor: 'black'
          }
        }
      };

      const lineChart = new Chart(ctx, {
        type: 'line',
        data: speedData,
        options: chartOptions
      });
    }
  };
})(jQuery, Drupal, drupalSettings);