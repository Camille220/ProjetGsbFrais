@extends('layouts.master')
@section('content')
    <h1>Liste des fiches de frais</h1>
    <table class="table table-bordered table-striped table-responsive">
        <thead>
        <th style="width:30%">Date</th>
        <th style="width:30%">Libellé</th>
        <th style="width:30%">Montant validé</th>
        <th style="width:20%">Modifier</th>
        <th style="width:20%">Supprimer</th>
        </thead>
        <tbody>
        @foreach($mesFrais as $ligne)
            <tr>
                <td>{{$ligne->date_fraishorsforfait}} </td>
                <td>{{$ligne->lib_fraishorsforfait}} </td>
                <td> {{$ligne->montant_fraishorsforfait}}</td>
                <td style="text-align:center;">
                    <a href="{{url('/modifierFraisHF')}}/{{$ligne->id_fraishorsforfait}}">
                    <span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top"
                          title="Modifier">
                    </span>
                    </a>
                </td>
                <td style="text-align:center;">
                    <a onclick="javascript:if (confirm('Suppression confirmée ?')) {
                    window.location='{{'/supprimerFraisHF' }}/{{ $ligne->id_fraishorsforfait}}'
					}">
                        <span class="glyphicon glyphicon-remove" data-toggle="tooltip" data-placement="top"
                              title="Supprimer"></span>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th colspan="2">Montant total</th>
            <td></td>
        </tr>
        </tfoot>
    </table>
    @include('vues/error')
@stop
