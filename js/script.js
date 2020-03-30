// ARRAY DO CARRINHO DE COMPRAS
let cart = [];

// VARIAVEL DA QUANTIDADE DE PIZZAS SELECIONADAS NO MODAL
let modalQt = 1;

// ARMAZENA A PIZZA PARA ADICIONAR NO CARRINHO
let modalKey = 0;

// COM ESSA FUNÇÃO, EU USO A VARIAVEL "c" PARA CHAMAR O QUERY SELECTOR, AO INVÉS DE FICAR DIGITANDO O TEMPO TODO
const c = (el)=> {
    return document.querySelector(el);
}

// FAÇO O MESMO DA FUNÇÃO ACIMA, PORÉM PARA O QUERYSELECTORALL
const cs = (el)=>document.querySelectorAll(el);

// LISTANDO AS PIZZAS

// MAPEANDO PIZZAS
pizzaJson.map((item, index)=>{
    // CLONANDO ITEM HTML
    let pizzaItem = c('.models .pizza-item').cloneNode(true); // cloneNode = PEGA OS DADOS DO ELEMENTO SELECIONADO E COPIA COM TUDO O QUE ESTA DENTRO

    // SETANDO A CHAVE DA PIZZA EM UM ATRIBUTO 'DATA-'
    pizzaItem.setAttribute('data-key', index);

    // TRAGO INFORMAÇÕES DO OBJETO
    pizzaItem.querySelector('.pizza-item--img img').src = item.img; // SUBSTITUO O ATRIBUTO src DA TAG <img />
    pizzaItem.querySelector('.pizza-item--price').innerHTML = `R$ ${item.price.toFixed(2)}`; // toFixed = FIXO O PREÇO COM DOIS ALGARISMOS DEPOIS DA VIRGULA
    pizzaItem.querySelector('.pizza-item--name').innerHTML = item.name;
    pizzaItem.querySelector('.pizza-item--desc').innerHTML = item.description;
    
    // BLOQUEANDO A AÇÃO DA TAG <a> QUE ATUALIZA A TELA QUANDO CLICADA NELA
    pizzaItem.querySelector('a').addEventListener('click', (e)=>{
        e.preventDefault();

        // PEGANDO AS INFORMAÇÕES DA PIZZA PELA CHAVE DA PIZZA
        let key = e.target.closest('.pizza-item').getAttribute('data-key'); // closest = ACHE O ELEMENTO MAIS PRÓXIMO QUE TEM A CHAVE 'pizza-item'

        // SETANDO A QUANTIDADE INICIAL SEMPRE EM 1
        modalQt = 1;

        // ARMAZENANDO A PIZZA PARA O CARRINHO
        modalKey = key;

        // PEGANDO INFORMAÇÕES DA PIZZA SELECIONADA
        c('.pizzaBig img').src = pizzaJson[key].img;
        c('.pizzaInfo h1').innerHTML = pizzaJson[key].name;
        c('.pizzaInfo--desc').innerHTML = pizzaJson[key].description;
        c('.pizzaInfo--actualPrice').innerHTML = `R$ ${pizzaJson[key].price.toFixed(2)}`;

        // REMOVENDO O TAMANHO SELECIONADO AUTOMATICAMENTE
        c('.pizzaInfo--size.selected').classList.remove('selected');

        // PEGANDO OS TAMANHOS CORRETAMENTE
        cs('.pizzaInfo--size').forEach((size, sizeIndex)=>{
            if(sizeIndex == 2){
                size.classList.add('selected');
            } // NESSE IF EU DEIXO O BOTÃO DE PIZZA GRANDE SEMPRE SELECIONADO POR QUESTÕES DE MARKETING
            size.querySelector('span').innerHTML = pizzaJson[key].sizes[sizeIndex];
        }); // FOREACH, VAI RODAR UMA FUNÇÃO PARA CADA UM DOS ITENS

        // QUANTIDADE DE PIZZAS
        c('.pizzaInfo--qt').innerHTML = modalQt;

        // GERANDO ANIMAÇÃO AO ABRIR MODAL (JS + CSS)
        c('.pizzaWindowArea').style.opacity = 0;

        // ABRINDO MODAL AO CLICAR NO <a>
        c('.pizzaWindowArea').style.display = 'flex';

        // GERANDO ANIMAÇÃO AO ABRIR MODAL (JS + CSS) ²
        setTimeout(()=>{
            c('.pizzaWindowArea').style.opacity = 1;
        }, 200);
       

    });

    // ADICIONO A ESTRUTURA DE LISTAGEM
    c('.pizza-area').append( pizzaItem ); // APPEND FUNCIONA SEMELHANTE AO innerHTML, PORÉM, AO INVÉS DE SUBSTITUIR, ELE ADICIONA
});

// EVENTOS DO MODAL

// FECHANDO MODAL
function closeModal(){
    c('.pizzaWindowArea').style.opacity = 0;

    setTimeout(()=>{
        c('.pizzaWindowArea').style.display = 'none';
    }, 500);
}

cs('.pizzaInfo--cancelButton, .pizzaInfo--cancelMobileButton').forEach((item)=>{
    // ADICIONO O EVENTO DE CLICK NA DIV E CHAMO A FUNÇÃO DE FECHAR O MODAL NO MOMENTO DO CLICK
    item.addEventListener('click', closeModal);
});

// ADICIONAR OU REMOVER QUANTIDADE DE PIZZAS
c('.pizzaInfo--qtmenos').addEventListener('click', ()=>{
    if(modalQt > 1){
        modalQt--;
        c('.pizzaInfo--qt').innerHTML = modalQt;
    }
    
});

c('.pizzaInfo--qtmais').addEventListener('click', ()=>{
    modalQt++;
    c('.pizzaInfo--qt').innerHTML = modalQt;

});

// SELECIONANDO O TAMANHO DA PIZZA
cs('.pizzaInfo--size').forEach((size, sizeIndex)=>{
   size.addEventListener('click', (e)=>{
        // CLICOU EM UM ITEM, DESMARCA TUDO E MARCA O SEU
        c('.pizzaInfo--size.selected').classList.remove('selected');
        size.classList.add('selected');
   });
});

// ADICIONANDO PRODUTO NO CARRINHO
c('.pizzaInfo--addButton').addEventListener('click', ()=>{
    // QUAL O TAMANHO?
    let size = c('.pizzaInfo--size.selected').getAttribute('data-key');

    // CRIANDO IDENTIFICADOR PARA PRODUTOS IGUAIS

    let identifier = pizzaJson[modalKey].id+'@'+size;

    // = - SUBSTITUI / == - VERIFICA
    let key = cart.findIndex((item)=>item.identifier == identifier);

    if(key > -1){
        cart[key].qt += modalQt;
    } else {
         // CRIANDO UM OBJETO PARA PEGAR OS DADOS DA PIZZA
        cart.push({
            identifier,
            id:pizzaJson[modalKey].id,
            size,
            qt:modalQt
        });
    }
    
    // ATUALIZANDO CARRINHO
    updateCart();

    // FECHANDO MODAL AO CLICAR EM ADICIONAR AO CARRINHO
    closeModal();
});

// ABRINDO CARRINHO MOBILE
c('.menu-openner').addEventListener('click', ()=>{
    if(cart.length > 0){
        c('aside').style.left = '0';
    }
});

// FECHANDO CARRINHO MOBILE
c('.menu-closer').addEventListener('click', ()=>{
    c('aside').style.left = '100vw';
});

// ATUALIZAR CARRINHO
function updateCart(){
    // ATUALIZANDO CARRINHO MOBILE
    c('.menu-openner span').innerHTML = cart.length;

    // CARRINHO APARECENDO PARA O USUÁRIO
    if(cart.length > 0){
        c('aside').classList.add('show');

        // ZERANDO A LISTA DE ITENS
        c('.cart').innerHTML = '';

        let subtotal = 0;
        let desconto = 0;
        let total = 0;

        // PEGANDO OS ITENS
        for(let i in cart){
            // IDENTIFICANDO QUAL É A PIZZA
            let pizzaItem = pizzaJson.find((item)=>item.id == cart[i].id);

            // CALCULANDO SUBTOTAL
            subtotal += pizzaItem.price * cart[i].qt;

            // CLONANDO O HTML ATRAVÉS DA CLASSE
            let cartItem = c('.models .cart--item').cloneNode(true);

            // PREENCHENDO ITENS
            let pizzaSizeName;
            switch(cart[i].size){
                case "0":
                    pizzaSizeName = 'P';
                    break;
                case "1":
                    pizzaSizeName = 'M';
                    break;
                case "2":
                    pizzaSizeName = 'G';
                    break;
            }

            let pizzaName = `${pizzaItem.name} (${pizzaSizeName})`;

            cartItem.querySelector('img').src = pizzaItem.img;  
            cartItem.querySelector('.cart--item-nome').innerHTML = pizzaName;
            cartItem.querySelector('.cart--item--qt').innerHTML = cart[i].qt;
            // DIMINUINDO QTD
            cartItem.querySelector('.cart--item-qtmenos').addEventListener('click', ()=>{
                if(cart[i].qt > 1){
                    cart[i].qt--;
                } else {
                    // REMOVE ITEM DO CARRINHO
                    cart.splice(i, 1);
                }
                updateCart();
            });
            // AUMENTANDO QTD
            cartItem.querySelector('.cart--item-qtmais').addEventListener('click', ()=>{
                cart[i].qt++;
                updateCart();
            });
            c('.cart').append(cartItem);
            }

            desconto = subtotal * 0.1;
            total = subtotal - desconto;

            c('.subtotal span:last-child').innerHTML = `R$ ${subtotal.toFixed(2)}`;
            c('.desconto span:last-child').innerHTML = `R$ ${desconto.toFixed(2)}`;
            c('.total span:last-child').innerHTML = `R$ ${total.toFixed(2)}`;
    } else {
        c('aside').classList.remove('show');
        c('aside').style.left = '100vw';
    }

}