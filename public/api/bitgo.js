var BitGo = require('bitgo');
var express = require('express');
var app = express();
var bodyParser = require('body-parser');
var ACCESS_TOKEN = 'v2x8b846362df0d5f14ca85ad46a88005b72751eb178f2f0a49adfbde32b13ba736';

// lets us grab data from the body of POST
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

// API Routes
var router = express.Router();

// Routes will all be prefixed with /api
app.use('/api', router);

// Set up port for server to listen on
var port = process.env.PORT || 3000;


//get latest prices  BTC
router.post('/authenticate', function(req, res) {

    var BitGoJS = require('bitgo');

    // if (process.argv.length < 3) {
    //   console.log("usage:\n\t" + process.argv[0] + " " + process.argv[1] + "v2xe8b0761221b99c1c279c8f1ea7833c86dd1a25f6e9e524e84f4b8467d777dec0");
    //   process.exit(-1);
    // }

    // For Testnet environment set env to test
    // For Livenet environment set env to prod
    var accessToken = 'v2x8b846362df0d5f14ca85ad46a88005b72751eb178f2f0a49adfbde32b13ba736';
    var bitgo = new BitGoJS.BitGo({ env: 'test', accessToken: accessToken });
    console.log("BitGoJS library version: " + bitgo.version());
    bitgo.session({})
        .then(function(response) {
            console.log(response);
            res.json(response);
        })
        .catch(function(err) {
            console.log(err);
        });
    //console.log(req.body.access_token);
})

router.post('/create-wallet', function(req, res) {


    var BitGoJS = require('bitgo');
    var accessToken = req.body.access_token;
    var bitgo = new BitGoJS.BitGo({ env: 'test', accessToken: accessToken });

    var label = req.body.lable;
    var walletPassword = req.body.walletPassword;

    // Create the wallet 
    bitgo.wallets().createWalletWithKeychains({ "passphrase": walletPassword, "label": 'ethwallet' }, function(err, result) {
        if (err) {
            console.dir(err);
            throw new Error("Error creating wallet!");
            res.json(err);
        } else { res.json(result.wallet.wallet); }
        console.log("Wallet Created: " + result.wallet.id());
        console.dir(result.wallet.wallet);

        // console.log("BACK THIS UP: "); 
        // console.log("User keychain encrypted xPrv: " + result.userKeychain.encryptedXprv); 
        // console.log("Backup keychain encrypted xPrv: " + result.backupKeychain.encryptedXprv); 
    });
})

//create wallet address for deposit
router.post('/create-wallet-coin', function(req, res) {


    var BitGoJS = require('bitgo');
    var accessToken = req.body.access_token;
    var bitgo = new BitGoJS.BitGo({ env: 'test', accessToken: accessToken });

    var label = req.body.lable;
    var walletPassword = req.body.walletPassword;
    //	var walletPassword = req.body.coin;

    bitgo.coin('teth').wallets()
        .generateWallet({ label: label, passphrase: walletPassword })
        .then(function(wallet) {
            // print the new wallet
            console.dir(wallet);
            res.json(wallet);

        });
})

router.post('/createTransaction', function(req, res) {


    var BitGoJS = require('bitgo');
    var accessToken = req.body.access_token;
    var bitgo = new BitGoJS.BitGo({ env: 'test', accessToken: accessToken });


    //	var walletPassword = req.body.coin;

    // 	let params = {
    //   amount: 0.01 * 1e8,
    //   address: '1LrNkG8yRvhoiDBZ7u99HsMsjxqJ1XVm9v',
    //   walletPassphrase: '123456'
    // };
    // wallet.send(params)
    // .then(function(transaction) {
    //   // print transaction details
    //   res.json(transaction);
    //   console.dir(transaction);
    // });

    let params = {
        recipients: [{
            amount: 0.01 * 1e8,
            address: '1LrNkG8yRvhoiDBZ7u99HsMsjxqJ1XVm9v',
        }]
    };





    var sendBitcoin = function() {
        console.log("Getting wallet..");

        // Now get the wallet 

        bitgo.wallets().get({ id: '2N8f85rvmR4Ha1cgNJShaqcztb7hm9v2FXM' }, function(err, wallet) {
            if (err) {
                console.log("Error getting wallet!");
                console.dir(err);
                return process.exit(-1);
            }
            console.log("Balance is: " + (wallet.balance() / 1e8).toFixed(4));

            // 	wallet.send(params)
            // .then(function(transaction) {
            //  res.json(transaction);
            //   console.dir(transaction);
            // });



        });
    };

    sendBitcoin();


})


// router.post('/send-coin', function(req, res) {


// 	var BitGoJS = require('bitgo');
// 	var accessToken = req.body.access_token;
// 	var bitgo = new BitGoJS.BitGo({env: 'test', accessToken: accessToken});

// 	var address = req.body.address;
// 	var walletPassword = req.body.walletPassphrase;

// 	let params = {
// 	  amount: 0.01 * 1e8,
// 	  address: address,
// 	  walletPassphrase: walletPassword
// 	};
// 	wallet.send(params)
// 	.then(function(transaction) {
// 		res.json(transaction);
// 	  // print transaction details
// 	  console.dir(transaction);
// 	});




// })


router.post('/send-coin', function(req, res) {


    var BitGoJS = require('bitgo');
    var accessToken = req.body.access_token;
    var bitgo = new BitGoJS.BitGo({ env: 'test', accessToken: accessToken });

    var address = req.body.address;
    var walletPassphrase = req.body.walletPassphrase;

    let params = {
        amount: 0.01 * 1e8,
        address: '2N8X9oaSzC2F56gmZBpANzaPmwE2b7YuA1C',
        walletPassphrase: '123456'
    };
    wallet.send(params)
        .then(function(transaction) {
            res.json(transaction);
            console.dir(transaction);
        });

});
// router.post('/send-coin', function(req, res) {


// 	var BitGoJS = require('bitgo');
// 	var accessToken = req.body.access_token;
// 	var bitgo = new BitGoJS.BitGo({env: 'test', accessToken: accessToken});

// 	var address = req.body.address;
// 	var walletPassphrase = req.body.walletPassphrase;

// 	let params = {
// 		  amount: 0.01 * 1e8,
// 		  address: address,
// 		  walletPassphrase: walletPassphrase
// 		};
// 		wallet.send(params)
// 		.then(function(transaction) {
// 		  // print transaction details
// 		  res.json(transaction);
// 		  console.dir(transaction);
// 		});



// })





router.post('/balance', function(req, res) {
    var BitGoJS = require('bitgo');
    var accessToken = req.body.access_token;
    var bitgo = new BitGoJS.BitGo({ env: 'test', accessToken: accessToken });

    var address = req.body.address;
    var type = req.body.type;


    bitgo.wallets().get({ type: type, id: address }, function(err, wallet) {

        if (err) {
            console.log(err);
            process.exit(-1);
            res.json(err);
        } else {
            res.json(wallet.balance());
        }
        console.log('Wallet balance is: ');
        console.log(wallet.balance() + ' Satoshis');
    });
})


router.post('/sendCoin', function(req, res) {
    var BitGoJS = require('bitgo');
    var accessToken = req.body.access_token;
    var bitgo = new BitGoJS.BitGo({ env: 'test', accessToken: accessToken });



    var walletId = req.body.walletId;
    var walletPassphrase = req.body.walletPassphrase;
    var destinationAddress = req.body.destinationAddress;
    var amountSatoshis = parseInt(req.body.amountSatoshis, 10);

    var sendBitcoin = function() {
        console.log("Getting wallet..");

        // Now get the wallet 

        bitgo.wallets().get({ id: walletId }, function(err, wallet) {
            if (err) {
                console.log("Error getting wallet!");
                console.dir(err);
                return process.exit(-1);
            }
            console.log("Balance is: " + (wallet.balance() / 1e8).toFixed(4));

            wallet.sendCoins({ address: destinationAddress, amount: amountSatoshis, walletPassphrase: walletPassphrase, minConfirms: 0 },
                function(err, result) {
                    if (err) {
                        console.log("Error sending coins!");
                        res.json(err);
                        console.dir(err);
                        return process.exit(-1);
                    }

                    console.dir(result);
                    res.json(result);
                    process.exit(0);
                }
            );
        });
    };

    sendBitcoin();
})







// Fire up server
app.listen(port);
// Print friendly message to console
console.log('Server listening on port ' + port);