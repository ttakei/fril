#!/usr/local/perl

use strict;
use warnings;

binmode STDOUT, ":utf8";

my %ca;
open FILE, '<:utf8','category_1.tsv';
while(<FILE>) {
    chomp;
    my ($a, $v) = split /\t/;
    $ca{$a} = $v;
}
close FILE;

my %cb;
open FILE, '<:utf8','category_2.tsv';
while(<FILE>) {
    chomp;
    my ($a, $b, $v) = split /\t/;
    $cb{$b} = $ca{$a}. " ". $v;
}
close FILE;

my %cc;
open FILE, '<:utf8','category_3.tsv';
while(<FILE>) {
    chomp;
    my ($a, $b, $c, $v) = split /\t/;
    $cc{$c} = $cb{$b}. " ". $v;
}
close FILE;

foreach my $key (keys(%cc)) {
    my $val = $cc{$key};
    print "insert into fril_data values ('category', '$key', '$val');", "\n";
}
