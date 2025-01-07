async function convertCurrency(from, to, amount) {
        const apiKey = 'e2e06e10118b4acd96ced9fab0d37109'; // Replace with your Open Exchange Rates API key
        const url = `https://openexchangerates.org/api/latest.json?app_id=${apiKey}`;

        try {
            const response = await fetch(url);
            if (!response.ok) throw new Error('Error fetching exchange rates');

            const data = await response.json();
            const exchangeRate = data.rates[to] / data.rates[from];

            if (!exchangeRate) throw new Error(`${to} not found`);

            const convertedAmount = (amount * exchangeRate).toFixed(2);
            console.log(`${amount} ${from} = ${convertedAmount} ${to}`);
            return convertedAmount;
        } catch (error) {
            console.error(error.message);
            return null; // Return null on error
        }
    }

    