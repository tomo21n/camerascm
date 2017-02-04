/*
 引数：user_id:ユーザID
 　　　ourder_id:Order Transaction ID
      input_url:検証→http://dev.world-viewing.com/ebay/orderrest.json
                本番→http://
      output_url:検証→/var/www/html/dev_camerascm/emslabel/

 */

var x = require('casper').selectXPath;
var fs = require('fs');
var inputdata;
var input_url;
var output_url;
var casper = require("casper").create({
    viewportSize: { width: 1800, height: 768 },
    verbose: true,
    logLevel: 'error'
});


if (casper.cli.has(2)){
    input_url = casper.cli.get(2);
}else{
    input_url = 'http://dev.world-viewing.com/ebay/orderrest.json';
}

if (casper.cli.has(3)){
    output_url = casper.cli.get(3);
}else{
    output_url = '/var/www/html/dev_camerascm/public/emslabel/';
}

if(casper.cli.has(0)){
    output_url = output_url + casper.cli.get(0) + '/';
    if(!fs.exists(output_url)){
        casper.echo(output_url);
        var wasSuccessful = fs.makeDirectory(output_url);
        if(wasSuccessful === true ? 0 : 1){
            casper.exit(0);
        };
    }
}

casper.userAgent("Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.98 Safari/537.36");
//casper.userAgent("Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.63 Safari/537.36");
casper.start();
if (casper.cli.has(0) && casper.cli.has(1)){
    casper.open(input_url, {
        method: 'post',
        data:   {
            'user_id' : casper.cli.get(0),
            'order_id': casper.cli.get(1)
        }
    });
    casper.then(function() {
        inputdata = JSON.parse(casper.getPageContent());
    });
}else{
    casper.exit();
}

// 指定した URL へ遷移する
//casper.thenOpen("https://www.int-mypage.post.japanpost.jp/mypage/M010000.do");
casper.thenOpen("https://www.int-mypage.post.japanpost.jp/index.html");


//日本語環境に変更
casper.then(function() {
    this.wait(500, function() {
        this.evaluate(function() {
            document.querySelector("select[name='localeSel']").value = 'ja';
        return true;
        });
        this.mouseEvent("click", "input.txt_form_button");
    });
});

//casper.then(function() {
//    this.echo("日本語環境に変更前");
//    this.evaluate(function() {
//        document.querySelector("select[name='localeSel']").value = 'ja';
//        return true;
//    });
//    this.waitFor(function check() {
//        return this.evaluate(function() {
//            return document.querySelectorAll('input.txt_form_button').length >= 1;
//        });
//    }, function() {
//        this.capture("/var/www/html/dev_camerascm/public/assets/img/photo/1.png");
//        this.mouseEvent("click", "input.txt_form_button");
//    });
//
//});


casper.then(function() {
    this.wait(500, function() {
        this.sendKeys("input[name='loginBean.id']", "monkey.tom.signum@gmail.com");
        this.sendKeys("input[name='loginBean.pw']", "rjfr4299");
//        this.capture("/var/www/html/dev_camerascm/public/assets/img/photo/2.png");
    });

//    this.waitFor(function check() {
//        return this.evaluate(function() {
//            return document.querySelectorAll('input.txt_form_button').length >= 1;
//        });
//    }, function() {
//        this.mouseEvent("click", x('//*[@id="loaded"]/table/tbody/tr[2]/td[2]/table/tbody/tr[2]/td/table/tbody/tr[1]/td/table/tbody/tr[2]/td[1]/table[1]/tbody/tr[2]/td[2]/div/table[2]/tbody/tr/td[2]/a'));
//    });
});
casper.then(function() {
    this.wait(100, function() {
//        this.capture("/var/www/html/dev_camerascm/public/assets/img/photo/3.png");
        //this.mouseEvent("click", x('//*[@id="loaded"]/table/tbody/tr[2]/td[2]/table/tbody/tr[2]/td/table/tbody/tr[1]/td/table/tbody/tr[2]/td[1]/table[1]/tbody/tr[2]/td[2]/div/table[2]/tbody/tr/td[2]/a'));
        this.mouseEvent("click", 'td div table.layout tbody tr td a img');
    });
});

//送り状作成
casper.then(function() {
//    this.waitFor(function check() {
//        return this.evaluate(function() {
//            return document.querySelectorAll('div.mrgTB10 ul.listmark-arrow a').length >= 1;
//        });
//    }, function() {
//        this.mouseEvent("click", x('//*[@id="loaded"]/table[4]/tbody/tr/td/div[1]/div/div[2]/table/tbody/tr/td/div[2]/ul[1]/li[1]/a'))
//    });
    this.wait(500, function() {
//        this.capture("/var/www/html/dev_camerascm/public/assets/img/photo/4.png");
        this.mouseEvent("click", x('//*[@id="loaded"]/table[4]/tbody/tr/td/div[1]/div/div[2]/table/tbody/tr/td/div[2]/ul[1]/li[1]/a'))
    });
});

//依頼主選択
//casper.then(function() {
//    this.waitFor(function check() {
//        return this.evaluate(function() {
//            return document.querySelectorAll('input.button').length >= 1;
//        });
//    }, function() {
//        this.mouseEvent("click", 'input[value="お届け先の選択へ"]')
//    },10000);
//	//this.mouseEvent("click", x('//*[@id="M060000_sel157516"]'))
//    //casper.capture("4.png");
//    //this.mouseEvent("click", 'input[value="お届け先の選択へ"]')
//    //this.mouseEvent("click", x('//*[@id="loaded"]/table[2]/tbody/tr[1]/td/div/div[4]/div[4]/input'))
//});
casper.then(function() {
    this.wait(500, function() {
//        this.capture("/var/www/html/dev_camerascm/public/assets/img/photo/5.png");
        this.mouseEvent("click", 'input[value="お届け先の選択へ"]')
    });
});

//お届け先選択（都度入力）
//casper.then(function() {
//    this.waitFor(function check() {
//        return this.evaluate(function() {
//            return document.querySelectorAll('input.button').length >= 1;
//        });
//    }, function() {
//        this.mouseEvent("click", 'input[id="M060400_sel-1"]')
//        //this.mouseEvent("click", x('//*[@id="M060400_sel-1"]'))
//    },10000);
//    //casper.capture("6.png");
//});
casper.then(function() {
    this.wait(500, function() {
//        this.capture("/var/www/html/dev_camerascm/public/assets/img/photo/6.png");
        this.mouseEvent("click", 'input[id="M060400_sel-1"]')
    });
});

casper.then(function() {
    this.wait(500, function() {
//      this.capture("/var/www/html/dev_camerascm/public/assets/img/photo/7.png");
      this.sendKeys("input[name='addrToBean.nam']", inputdata.buyer_name);
      this.evaluate(function(countryCode) {
            document.querySelector("select[name='addrToBean.couCode']").value = countryCode;
            return true;
        },inputdata.buyer_country_code);
      if(inputdata.buyer_address2 == ''){
          this.sendKeys("input[name='addrToBean.add2']", inputdata.buyer_address1);
      }else{
          this.sendKeys("input[name='addrToBean.add1']", inputdata.buyer_address1);
          this.sendKeys("input[name='addrToBean.add2']", inputdata.buyer_address2);
      }
      this.sendKeys("input[name='addrToBean.add3']", inputdata.buyer_address3);
      this.sendKeys("input[name='addrToBean.pref']", inputdata.buyer_pref);
      this.sendKeys("input[name='addrToBean.postal']", inputdata.buyer_postal);
      this.sendKeys("input[name='addrToBean.tel']", inputdata.buyer_tel);
      //this.sendKeys("input[name='addrToBean.fax']", inputdata.addToFax);
      this.sendKeys("input[name='addrToBean.mail']", inputdata.buyer_email);
    });

});
casper.then(function() {
//    this.capture("/var/www/html/dev_camerascm/public/assets/img/photo/8.png");
    this.mouseEvent("click", 'input[value="この内容で登録する"]')
  //this.mouseEvent("click", x('//*[@id="loaded"]/table[2]/tbody/tr[1]/td/div/div[4]/input'));
});
//EMS,ePacket選択
casper.then(function() {
    this.wait(500, function() {
//        this.capture("/var/www/html/dev_camerascm/public/assets/img/photo/9.png");
        if(inputdata.shipping_type == 'ePacket'){
            this.mouseEvent("click", x('//*[@id="M060800_shippingBean_sendType4"]'));
        }else{
            this.mouseEvent("click", x('//*[@id="M060800_shippingBean_sendType1"]'));
        }
    });
});

casper.then(function() {
//    this.waitFor(function check() {
//        return this.evaluate(function() {
//            return document.querySelector('input[name="item_button01"]').disabled == false;
//        });
//    }, function() {
//        this.mouseEvent("click", x('//*[@id="loaded"]/table[2]/tbody/tr[1]/td/div/input[2]'));
//    });
    this.wait(500, function() {
//        this.capture("/var/www/html/dev_camerascm/public/assets/img/photo/10.png");
        this.mouseEvent("click", x('//*[@id="loaded"]/table[2]/tbody/tr[1]/td/div/input[2]'));
    });
});


casper.then(function() {
//    this.waitFor(function check() {
//        return this.evaluate(function() {
//            return document.querySelectorAll('input.button2').length >= 1;
//        });
//    }, function() {
//        this.mouseEvent("click", x('//*[@id="loaded"]/table[2]/tbody/tr[1]/td/div/div/div[2]/table[2]/tbody/tr[2]/td[6]/input'))
//    });
    this.wait(500, function() {
//        this.capture("/var/www/html/dev_camerascm/public/assets/img/photo/11.png");
        this.mouseEvent("click", x('//*[@id="loaded"]/table[2]/tbody/tr[1]/td/div/div/div[2]/table[2]/tbody/tr[2]/td[6]/input'))
    });
});


casper.then(function() {
    this.wait(500, function() {
//        this.capture("/var/www/html/dev_camerascm/public/assets/img/photo/12.png");
        this.sendKeys("input[name='itemBean.pkg']", inputdata.item_pkg_category);
        this.evaluate(function(SalePrice) {
                document.querySelector("input[name='itemBean.cost.value']").value = SalePrice;
                return true;
            },inputdata.sale_round_price);
        this.evaluate(function(CurUnit) {
                document.querySelector("select[name='itemBean.curUnit']").value = CurUnit;
                return true;
            },inputdata.itemCurUnit);
        this.mouseEvent("click", 'input[value="この内容で登録する"]');

    });

//    this.waitFor(function check() {
//        return this.evaluate(function() {
//            return document.querySelectorAll('input.button').length >= 1;
//        });
//    }, function() {
//        this.mouseEvent("click", 'input[value="この内容で登録する"]');
//  });
});

casper.then(function() {
//    this.waitFor(function check() {
//           return this.evaluate(function() {
//               return document.querySelectorAll('input.button').length >= 1;
//           });
//       }, function() {
//        this.capture("/var/www/html/dev_camerascm/public/assets/img/photo/13.png");
//        this.mouseEvent("click", 'input[value="　登　録　"]');
//    });
    this.wait(500, function() {
//        this.capture("/var/www/html/dev_camerascm/public/assets/img/photo/13.png");
        this.mouseEvent("click", 'input[value="　登　録　"]');
    });
});

casper.then(function() {
//    this.waitFor(function check() {
//        return this.evaluate(function() {
//            return document.querySelectorAll('input.button').length >= 1;
//        });
//    }, function() {
//        this.capture("/var/www/html/dev_camerascm/public/assets/img/photo/14.png");
//        this.mouseEvent("click", 'input[value="内容品リスト一覧へ戻る"]');
//    });
    this.wait(500, function() {
//        this.capture("/var/www/html/dev_camerascm/public/assets/img/photo/14.png");
        this.mouseEvent("click", 'input[value="内容品リスト一覧へ戻る"]');
    });
});

casper.then(function() {
    this.wait(500, function() {
        this.evaluate(function() {
            document.querySelector("input[name='itemSearchBean.chk']").checked = true;
            return true;
        });
//        this.capture("/var/www/html/dev_camerascm/public/assets/img/photo/15.png");
        this.mouseEvent("click", 'input[value="送り状に内容品を登録"]');
    });
});

casper.then(function() {
    this.wait(500, function() {
//        this.capture("/var/www/html/dev_camerascm/public/assets/img/photo/16.png");
        this.sendKeys("input[name='itemCount']", inputdata.itemCount);
      this.evaluate(function(SaleYenPrice) {
            document.querySelector("input[name='shippingBean.pkgTotalPrice.value']").value = SaleYenPrice;
            return true;
      },inputdata.sale_round_yen_price);
      this.evaluate(function() {
            //document.querySelector("select[name='shippingBean.pkgType']").value = inputdata.pkgType;
            document.querySelector("select[name='shippingBean.pkgType']").value = 3;
            return true;
        });
      this.evaluate(function() {
            //document.querySelector("input[name='shippingBean.noCm']").checked = true;
            document.querySelector("input[name='shippingBean.noCm']").checked = false;
            return true;
        });
      this.evaluate(function() {
            document.querySelector("input[name='ShippingBean.danger']").checked = true;
            return true;
        });
    });

});

casper.then(function() {
//    this.capture("/var/www/html/dev_camerascm/public/assets/img/photo/17.png");
    this.mouseEvent("click", 'input[value="発送関連情報の入力へ"]');
    casper.log('17.png', 'info');
});


//発送関連情報登録
casper.then(function() {
    this.wait(500, function() {
//        this.capture("/var/www/html/dev_camerascm/public/assets/img/photo/18.png");
        this.evaluate(function(shipDate) {
          document.querySelector("select[name='shippingBean.sendDate.YMD']").value = shipDate;
          return true;
      },inputdata.shipdate);
      if(inputdata.shipping_type !== 'ePacket'){
          this.sendKeys("input[name='shippingBean.num.value']", inputdata.itemCount);
          this.sendKeys("input[name='shippingBean.totalNum.value']", inputdata.itemCount);
            this.evaluate(function(SaleYenPrice) {
                document.querySelector("input[name='shippingBean.damges']").value = SaleYenPrice;
                return true;
            },inputdata.sale_round_yen_price);
            this.sendKeys("input[name='shippingBean.damges']", {modifiers: 'alt'});
      }
      this.evaluate(function() {
            document.querySelector("input[name='shippingBean.ctrlMailConfBean.fromConf1']").checked = true;
            return true;
        });
      this.evaluate(function() {
            document.querySelector("input[name='shippingBean.ctrlMailConfBean.fromConf3']").checked = false;
            return true;
        });
      this.evaluate(function() {
            document.querySelector("input[name='shippingBean.ctrlMailConfBean.fromConf4']").checked = false;
            return true;
        });
      this.evaluate(function() {
            document.querySelector("input[name='shippingBean.ctrlMailConfBean.fromConf5']").checked = false;
            return true;
        });
      this.evaluate(function() {
            document.querySelector("input[name='shippingBean.ctrlMailConfBean.fromConf6']").checked = false;
            return true;
        });
      this.evaluate(function() {
            document.querySelector("input[name='shippingBean.ctrlMailConfBean.fromConf2']").checked = false;
            return true;
        });
        this.evaluate(function() {
            document.querySelector("input[name='shippingBean.ctrlMailConfBean.fromConf7']").checked = true;
            return true;
        });
        this.evaluate(function() {
            document.querySelector("input[name='shippingBean.ctrlMailConfBean.toConf1']").checked = false;
            return true;
        });
      this.evaluate(function() {
            document.querySelector("input[name='shippingBean.ctrlMailConfBean.toConf3']").checked = true;
            return true;
        });
      this.evaluate(function() {
            document.querySelector("input[name='shippingBean.ctrlMailConfBean.toConf4']").checked = false;
            return true;
        });
      this.evaluate(function() {
            document.querySelector("input[name='shippingBean.ctrlMailConfBean.toConf5']").checked = false;
            return true;
        });
      this.evaluate(function() {
            document.querySelector("input[name='shippingBean.ctrlMailConfBean.toConf6']").checked = false;
            return true;
        });
      this.evaluate(function() {
            document.querySelector("input[name='shippingBean.ctrlMailConfBean.toConf2']").checked = true;
            return true;
        });
      this.evaluate(function() {
            document.querySelector("input[name='shippingBean.ctrlMailConfBean.toConf7']").checked = false;
            return true;
        });
    });
});

casper.then(function() {
//    this.capture("/var/www/html/dev_camerascm/public/assets/img/photo/19.png");
    this.mouseEvent("click", x('//*[@id="loaded"]/table[2]/tbody/tr[1]/td/div/div[8]/input'));
    casper.log('19.png', 'info');

});


//送り状を登録する
casper.then(function() {
//    this.waitFor(function check() {
//        return this.evaluate(function() {
//            return document.querySelectorAll('input.button').length >= 1;
//        });
//    }, function() {
//        this.capture("/var/www/html/dev_camerascm/public/assets/img/photo/20.png");
//        this.mouseEvent("click", 'input[value="送り状を登録する"]');
//    });
    this.wait(500, function() {
//        this.capture("/var/www/html/dev_camerascm/public/assets/img/photo/20.png");
        this.mouseEvent("click", 'input[value="送り状を登録する"]');
    });
});

//casper.then(function() {
//    this.waitFor(function check() {
//        return this.evaluate(function() {
//            return document.querySelectorAll('input.button').length >= 1;
//        });
//    }, function() {
//        this.capture("/var/www/html/dev_camerascm/public/assets/img/photo/19.png");
//        this.mouseEvent("click", 'input[value="送り状を登録する"]');
//    });
//});

//送り状をPDFにする
casper.then(function() {
//    this.waitFor(function check() {
//           return this.evaluate(function() {
//               return document.querySelectorAll('input.button').length >= 1;
//           });
//       }, function() {
//        this.capture("/var/www/html/dev_camerascm/public/assets/img/photo/21.png");
//        this.mouseEvent("click", 'input[value="注意事項に同意して送り状を印刷"]');
//    });
    this.wait(500, function() {
//        this.capture("/var/www/html/dev_camerascm/public/assets/img/photo/21.png");
        this.mouseEvent("click", 'input[value="注意事項に同意して送り状を印刷"]');
        casper.log('21.png', 'info');

    });
});

//送り状をダウンロードする
casper.then(function() {
    this.wait(2000, function() {
//        this.capture("/var/www/html/dev_camerascm/public/assets/img/photo/22.png");
        var pdfname = this.evaluate(function() {
            return document.querySelector('div.boxMain iframe').src;
        });
      var originalname =  pdfname.substring(pdfname.lastIndexOf('/')+1, pdfname.length);
      if(CheckLength(inputdata.buyer_name,1)){
          var output_file =  originalname.substr(13,8) + '_'+ originalname.substr(27,13) + '_'+ inputdata.buyer_country_code + '.pdf';
      }else{
          var output_file =  originalname.substr(13,8) + '_'+ originalname.substr(27,13) + '_'+ inputdata.buyer_country_code + '_'+ inputdata.buyer_name + '.pdf';
      }
      this.download(pdfname, output_url +output_file);
      var outputobj = {
                output_path :output_url,
                file_name   :output_file,
                tracking_number :originalname.substr(27,13),
                buyer_name :inputdata.buyer_name
      };
      this.echo(JSON.stringify(outputobj));
    });
});


// 処理を開始する
casper.run();

/****************************************************************
 * 全角/半角文字判定
 *
 * 引数 ： str チェックする文字列
 * flg 0:半角文字、1:全角文字
 * 戻り値： true:含まれている、false:含まれていない
 *
 ****************************************************************/
function CheckLength(str,flg) {
    for (var i = 0; i < str.length; i++) {
        var c = str.charCodeAt(i);
        // Shift_JIS: 0x0 ～ 0x80, 0xa0 , 0xa1 ～ 0xdf , 0xfd ～ 0xff
        // Unicode : 0x0 ～ 0x80, 0xf8f0, 0xff61 ～ 0xff9f, 0xf8f1 ～ 0xf8f3
        if ( (c >= 0x0 && c < 0x81) || (c == 0xf8f0) || (c >= 0xff61 && c < 0xffa0) || (c >= 0xf8f1 && c < 0xf8f4)) {
            if(!flg) return true;
        } else {
            if(flg) return true;
        }
    }
    return false;
}