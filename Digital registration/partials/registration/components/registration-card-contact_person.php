<?
/** @var \app\hig\MRegistration $registration; */

$colspan = count($registration->registrationCard->contactPersons) - 1;
$registrationCard = $registration->registrationCard;
?>
<style>
    td {
        width: 175px;
    }
    #table-copy_of_registration {
        margin: 25px 0;
        border: none;
        padding: 0;
        border-spacing: 0;
        width: 100%;
    }
    #table-copy_of_registration .heading {
        font-weight: bold;
    }
    #table-copy_of_registration tr {
        padding: 0;
        margin: 0;
    }
    #table-copy_of_registration td {
        vertical-align: top;
        margin: 0;
        padding: 0;
        word-wrap:break-word;
        overflow: auto;
    }
    .heading {
        width: 350px;
    }
    .offset-top {
        padding-top: 20px;
    }
    .subcat {
        font-weight: normal;
        font-style: italic;
    }
    .descriptive {
        word-wrap: break-word;
    }
</style>
<table class="table" id="table-copy_of_registration">
	<? // RELATION ?>
    <tr>
        <td class="heading">Participant</td>
        <td colspan="<?=$colspan;?>"></td>
    </tr>
	<tr>
		<td class="heading subcat">Naam</td>
		<td class="descriptive" colspan="<?=$colspan;?>"><?= $registrationCard->relation->name; ?></td>
	</tr>
	<? // ADDRESS ?>
    <tr>
        <td class="heading subcat">Woonadres</td>
        <td colspan="<?=$colspan;?>">
	        <?= $registrationCard->address->street; ?> <?= $registrationCard->address->number; ?><?= $registrationCard->address->numberSuffix; ?> <br />
	        <?= $registrationCard->address->postalCode; ?> <?= $registrationCard->address->city; ?> <br />
	        <? if ($registrationCard->address->country !== strtolower('nederland')): ?>
	            <?= $registrationCard->address->country; ?>
	        <? endif; ?>
        </td>
    </tr>
	<? // BANK ACCOUNT ?>
    <tr>
        <td class="heading subcat">IBAN-rekeningnummer t.b.v. betaling en uitkering</td>
        <td colspan="<?=$colspan;?>"><?= $registrationCard->bankAccount->iban; ?> t.n.v. <?= $registrationCard->bankAccount->ascription; ?></td>
    </tr>

	<?
    // voor een particulier kan dit altijd maar 1 contactpersoon zijn
    foreach ($registrationCard->contactPersons as $contactPerson): ?>
        <tr>
            <td class="heading offset-top subcat">Wat is de herkomst van middelen?</td>
            <td class="offset-top" colspan="<?=$colspan;?>"><?= $contactPerson->originOfResources; ?></td>
        </tr>
        <? // CORRESPONDENCE TYPE ?>
        <tr>
            <td class="heading subcat">Correspondentiewijze</td>
            <td colspan="<?=$colspan;?>"><?= $registrationCard->relation->transactionalMail == 1 ? 'Per post' : 'Digitaal'; ?></td>
        </tr>
        <tr>
            <td class="heading subcat">Telefoonnummer(s)</td>
            <td>
                <? foreach ($contactPerson->getPhoneNumbers() as $phoneNumber): ?>
                    <?= $phoneNumber->number; ?><br />
                <? endforeach; ?>
            </td>
        </tr>
        <tr>
            <td class="heading subcat">E-mailadres</td>
            <td colspan="<?=$colspan;?>"><?= $contactPerson->emailAddress; ?></td>
        </tr>
        <tr>
            <td class="heading subcat">Nationaliteit</td>
            <td colspan="<?=$colspan;?>"><?= $contactPerson->nationality; ?></td>
        </tr>
        <tr>
            <td class="heading subcat">PEP</td>
            <td colspan="<?=$colspan;?>"><?= isset($contactPerson->isPep) && $contactPerson->isPep ? 'Ja' : 'Nee'; ?></td>
        </tr>
        <tr>
            <td class="heading subcat">Bent u een Amerikaanse staatsburger of woonachtig in de Verenigde Staten?</td>
            <td colspan="<?=$colspan;?>"><?= isset($contactPerson->residentOfUnitedStates) && $contactPerson->residentOfUnitedStates ? 'Ja' : 'Nee'; ?></td>
        </tr>
        <tr>
            <td class="heading subcat">Wat is uw huidige beroep?</td>
            <td colspan="<?=$colspan;?>"><?= isset($contactPerson->currentProfession) ? $contactPerson->currentProfession : ""; ?></td>
        </tr>
        <tr>
            <td class="heading subcat">In welke branche bent u werkzaam (geweest)?</td>
            <td colspan="<?=$colspan;?>"><?= isset($contactPerson->industry) ? $contactPerson->industry : ""; ?></td>
        </tr>
        <? if (empty($contactPerson->relationId)) { ?>
        <tr>
            <td class="heading subcat">Legitimatiebewijs ge&uuml;pload</td>
            <td><?= $contactPerson->hasUploadedIdFile() ? 'Ja' : 'Nee'; ?></td>
        </tr>
        <? } ?>
    <? endforeach; ?>
</table>