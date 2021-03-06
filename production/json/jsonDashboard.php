<?php
    require_once ('../../../includes/OracleCielo.class.php');

    $oraCielo   = new OracleCielo ();
    $conexao    = $oraCielo->getCon();

    #===================================================================================================================
    #TOTALIZADOR

    //Veiculos
    $sqlTotalVeiculos = "
        SELECT 
          count(*) AS total_veiculos
        FROM 
          HELP_TRACK_VEICULO
    ";

    $respostaTotalVeiculos = oci_parse($conexao, $sqlTotalVeiculos);

    if(oci_execute($respostaTotalVeiculos)){
        $totalVeiculos = oci_fetch_assoc($respostaTotalVeiculos);
    }

    //Atrasados
    $sqlTotalAtrasados = "
        SELECT 
          count(*) AS total_atrasados
        FROM 
          HELP_TRACK_VIAGEM
        WHERE
          status = 1
          --AND processada = 'F'
    ";

    $respostaTotalAtrasados = oci_parse($conexao, $sqlTotalAtrasados);

    if(oci_execute($respostaTotalAtrasados)){
        $totalAtrasados = oci_fetch_assoc($respostaTotalAtrasados);
    }

    //Aguardando inicio
    $sqlTotalAguardando = "
            SELECT 
              count(*) AS total_aguardando
            FROM 
              HELP_TRACK_VIAGEM
            WHERE
              situacao = 2
              --AND processada = 'F'
        ";

    $respostaTotalAguardando = oci_parse($conexao, $sqlTotalAguardando);

    if(oci_execute($respostaTotalAguardando)){
        $totalAguardando = oci_fetch_assoc($respostaTotalAguardando);
    }

    //No prazo
    $sqlTotalNoPrazo = "
        SELECT 
          count(*) AS total_no_prazo
        FROM 
          HELP_TRACK_VIAGEM
        WHERE
          status = 2
          --AND processada = 'F' 
    ";

    $respostaTotalNoPrazo = oci_parse($conexao, $sqlTotalNoPrazo);

    if(oci_execute($respostaTotalNoPrazo)){
        $totalNoPrazo = oci_fetch_assoc($respostaTotalNoPrazo);
    }

    //Condutores
    $sqlTotalCondutores = "
        SELECT
          count(*) AS total_condutores
        FROM
          HELP_TRACK_CONDUTOR
    ";

    $respostaTotalCondutores = oci_parse($conexao, $sqlTotalCondutores);

    if(oci_execute($respostaTotalCondutores)){
        $totalCondutores = oci_fetch_assoc($respostaTotalCondutores);
    }

    //Viagens
    $sqlTotalViagens = "
        SELECT
          count(*) AS total_viagens
        FROM
          HELP_TRACK_VIAGEM
        --WHERE processada = 'T'
    ";

    $respostaTotalViagens = oci_parse($conexao, $sqlTotalViagens);

    if(oci_execute($respostaTotalViagens)){
        $totalViagens = oci_fetch_assoc($respostaTotalViagens);
    }

    //Viagens finalizadas hoje
    $sqlTotalViagensDia = "
        SELECT
          count(*) AS total_viagens_dia
        FROM
          HELP_TRACK_VIAGEM
          WHERE trunc(data_hora_chegada) = to_char(SYSDATE, 'DD/MM/YYYY')
    ";

    $respostaTotalViagensDia = oci_parse($conexao, $sqlTotalViagensDia);

    if(oci_execute($respostaTotalViagensDia)){
        $totalViagensDia = oci_fetch_assoc($respostaTotalViagensDia);
    }

    //Viagens atrasados hoje
    $sqlTotalAtrasosDia = "
            SELECT
          count(*) AS total_atrasos_dia
        FROM
          HELP_TRACK_VIAGEM
          WHERE trunc(data_hora_chegada) = to_char(SYSDATE, 'DD/MM/YYYY')
          AND status = 1
        ";

    $respostaTotalAtrasosDia = oci_parse($conexao, $sqlTotalAtrasosDia);

    if(oci_execute($respostaTotalAtrasosDia)){
        $totalAtrasosDia = oci_fetch_assoc($respostaTotalAtrasosDia);
    }

    //Viagens prazo hoje
    $sqlTotalPrazoDia = "
                SELECT
              count(*) AS total_prazo_dia
            FROM
              HELP_TRACK_VIAGEM
              WHERE trunc(data_hora_chegada) = to_char(SYSDATE, 'DD/MM/YYYY')
              AND status = 2
            ";

    $respostaTotalPrazoDia = oci_parse($conexao, $sqlTotalPrazoDia);

    if(oci_execute($respostaTotalPrazoDia)){
        $totalPrazoDia = oci_fetch_assoc($respostaTotalPrazoDia);
    }

    //Viagens acontecendo agora
    $sqlViagensAgora = "
                    SELECT
                  count(*) AS total_viagens_agora
                FROM
                  HELP_TRACK_VIAGEM
                  WHERE 
                  SITUACAO = 3
                ";

    $respostaTotalViagensAgora = oci_parse($conexao, $sqlViagensAgora);

    if(oci_execute($respostaTotalViagensAgora)){
        $totalViagensAgora = oci_fetch_assoc($respostaTotalViagensAgora);
    }

    //Viagens atrasos agora
    $sqlAtrasosAgora = "
                        SELECT
                      count(*) AS total_atrasos_agora
                    FROM
                      HELP_TRACK_VIAGEM
                      WHERE 
                      situacao = 3
                      and status = 1
                    ";

    $respostaTotalAtrasosAgora = oci_parse($conexao, $sqlAtrasosAgora);

    if(oci_execute($respostaTotalAtrasosAgora)){
        $totalAtrasosAgora = oci_fetch_assoc($respostaTotalAtrasosAgora);
    }


    //Viagens prazo agora
    $sqlPrazoAgora = "
                        SELECT
                      count(*) AS total_prazo_agora
                    FROM
                      HELP_TRACK_VIAGEM
                      WHERE 
                      situacao = 3
                      and status = 2
                    ";

    $respostaTotalPrazoAgora = oci_parse($conexao, $sqlPrazoAgora);

    if(oci_execute($respostaTotalPrazoAgora)){
        $totalPrazoAgora = oci_fetch_assoc($respostaTotalPrazoAgora);
    }

    //Viagens pode atrasar agora
    $sqlPodeAtrasarAgora = "
                            SELECT
                          count(*) AS total_podeatrasar_agora
                        FROM
                          HELP_TRACK_VIAGEM
                          WHERE 
                          situacao = 3
                          and status = 3
                        ";

    $respostaTotalPodeAtrasarAgora = oci_parse($conexao, $sqlPodeAtrasarAgora);

    if(oci_execute($respostaTotalPodeAtrasarAgora)){
        $totalPodeAtrasarAgora = oci_fetch_assoc($respostaTotalPodeAtrasarAgora);
    }


    $array['totalVeiculos']     = $totalVeiculos;
    $array['totalCondutores']   = $totalCondutores;
    $array['totalViagens']      = $totalViagens;
    $array['totalAtrasados']    = $totalAtrasados;
    $array['totalNoPrazo']      = $totalNoPrazo;
    $array['totalViagensDia']   = $totalViagensDia;
    $array['totalAtrasosDia']   = $totalAtrasosDia;
    $array['totalPrazoDia']     = $totalPrazoDia;
    $array['totalAguardando']   = $totalAguardando;
    $array['totalViagensAgora'] = $totalViagensAgora;
    $array['totalAtrasosAgora'] = $totalAtrasosAgora;
    $array['totalPrazoAgora']   = $totalPrazoAgora;
    $array['totalPodeAtrasarAgora']   = $totalPodeAtrasarAgora;

    oci_free_statement($respostaTotalVeiculos);
    oci_free_statement($respostaTotalCondutores);
    oci_free_statement($respostaTotalViagens);
    oci_free_statement($respostaTotalAtrasados);
    oci_free_statement($respostaTotalNoPrazo);
    oci_free_statement($respostaTotalViagensDia);
    oci_close($conexao);

    $json = $array;

    //start output
    header('Content-Type: application/x-json');
    echo json_encode($json);
?>