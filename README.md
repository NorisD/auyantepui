# Orders D96A Reader

Questo progetto dimostra come leggere un file EDI del tipo **ORDERS D96A** utilizzando PHP.

## Utilizzo

1. Posizionare il file EDI da leggere nella cartella `samples` oppure fornire il percorso completo.
2. Eseguire lo script di esempio indicando il file da analizzare:

```bash
php examples/example.php samples/orders_example.edi
```

Lo script mostrerà un array con i segmenti trovati nel file.

## Generare un ORDRSP D96A

1. Preparare un file JSON con i dati dell'ordine (vedere `samples/order_example.json`).
2. Lanciare lo script di generazione indicando file di input e file di destinazione:

```bash
php examples/generate_ordrsp.php samples/order_example.json samples/ordrsp_example.edi
```

Il file EDI verrà scritto nel percorso specificato.
